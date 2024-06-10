<?php

require_once('AbstractEntityManager.php');
require_once('Message.php');

/**
 * Classe qui gère les conversations.
 */
class ConversationManager extends AbstractEntityManager
{
    /**
     * Vérifie si une conversation existe entre deux utilisateurs, sinon crée une nouvelle conversation.
     * @param int $recipientId : l'identifiant du destinataire.
     * @param int $senderId : l'identifiant de l'expéditeur.
     * @return int : l'identifiant de la conversation.
     */
    public function checkOrCreateConversation(int $recipientId, int $senderId): int
    {
        try {
            $sql = "
                SELECT 
                    conversation_id 
                FROM 
                    conversations 
                WHERE 
                    (user1_id = :user1_id AND user2_id = :user2_id) 
                OR 
                    (user1_id = :user2_id AND user2_id = :user1_id)
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'user1_id' => $senderId,
                'user2_id' => $recipientId
            ]);

            $conversation = $statement->fetch();

            if ($conversation) {
                // La conversation existe déjà.
                return $conversation['conversation_id'];
            } else {
                // La conversation n'existe pas, il faut la créer.
                $sql = 'INSERT INTO conversations (user1_id, user2_id) VALUES (:user1_id, :user2_id)';
                $statement = $this->pdo->prepare($sql);
                $statement->execute([
                    'user1_id' => $senderId,
                    'user2_id' => $recipientId
                ]);

                return $this->pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Insère un message dans une conversation.
     * @param int $conversationId : l'identifiant de la conversation.
     * @param int $senderId : l'identifiant de l'expéditeur.
     * @param int $recipientId : l'identifiant du destinataire.
     * @param string $message : le contenu du message.
     * @return void
     */
    public function insertMessage(int $conversationId, int $senderId, int $recipientId, string $message): void
    {
        try {
            $sql = "INSERT INTO messages (conversation_id, sender_id, receiver_id, message) VALUES (:conversation_id, :sender_id, :receiver_id, :message)";
            $statement = $this->pdo->prepare($sql);
            $result = $statement->execute([
                'conversation_id' => $conversationId,
                'sender_id' => $senderId,
                'receiver_id' => $recipientId,
                'message' => $message
            ]);

            if ($result === false) {
                throw new Exception("Erreur lors de l'insertion du message.");
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère les messages d'une conversation par son identifiant.
     * @param int $conversationId : l'identifiant de la conversation.
     * @return array : un tableau de messages.
     */
    public function getMessagesByConversationId(int $conversationId): array
    {
        try {
            $sql = "
                SELECT * 
                FROM messages 
                WHERE conversation_id = :conversation_id 
                ORDER BY sent_at ASC
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['conversation_id' => $conversationId]);

            $messages = [];

            while ($messageData = $statement->fetch(PDO::FETCH_ASSOC)) {
                $messages[] = Message::fromArray($messageData);
            }

            return $messages;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère les identifiants des conversations d'un utilisateur.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @return array : un tableau d'identifiants de conversations.
     */
    public function getUserConversationsIds(int $userConnectedId): array
    {
        try {
            $sql = "
                SELECT conversation_id
                FROM conversations
                WHERE user1_id = :user_id 
                OR user2_id = :user_id
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['user_id' => $userConnectedId]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère les derniers messages de plusieurs conversations.
     * @param array $conversationIds : un tableau d'identifiants de conversations.
     * @return array : un tableau des derniers messages de chaque conversation.
     */
    public function getLastMessagesByConversationIds(array $conversationIds): array
    {
        // On extrait les valeurs des IDs de conversation depuis les tableaux associatifs.
        $conversationIds = array_column($conversationIds, 'conversation_id');

        // On convertit le tableau d'IDs en une chaîne de caractères séparée par des virgules pour la requête SQL.
        $conversationIdsPlaceholder = implode(',', array_fill(0, count($conversationIds), '?'));

        try {
            $sql = "
                SELECT m.*
                FROM messages m
                INNER JOIN (
                    SELECT conversation_id, MAX(sent_at) AS max_sent_at
                    FROM messages
                    WHERE conversation_id IN ($conversationIdsPlaceholder)
                    GROUP BY conversation_id
                ) latest_msg ON m.conversation_id = latest_msg.conversation_id AND m.sent_at = latest_msg.max_sent_at
                ORDER BY m.sent_at DESC
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($conversationIds);

            $messages = [];

            while ($messageData = $statement->fetch(PDO::FETCH_ASSOC)) {
                $messages[] = Message::fromArray($messageData);
            }

            return $messages;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère une conversation existante entre l'utilisateur connecté et le destinataire d'un message.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @param int $recipientId : l'identifiant du destinataire.
     * @return int|null : l'identifiant de la conversation, ou null si aucune conversation trouvée.
     */
    public function getConversationId(int $userConnectedId, int $recipientId): ?int
    {
        try {
            $sql = "
                SELECT conversation_id
                FROM conversations
                WHERE (user1_id = :user_id AND user2_id = :recipient_id) 
                OR (user1_id = :recipient_id AND user2_id = :user_id)
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'user_id' => $userConnectedId,
                'recipient_id' => $recipientId
            ]);

            $conversationId = $statement->fetchColumn();

            return $conversationId !== false ? (int)$conversationId : null;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Compte le nombre de messages non lus pour un utilisateur spécifique.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @return int : le nombre de messages non lus pour l'utilisateur.
     */
    public function countUnreadMessagesForUser(int $userId): int
    {
        try {
            $sql = "
                SELECT COUNT(*) 
                FROM messages 
                WHERE receiver_id = :user_id 
                AND read_at IS NULL
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['user_id' => $userId]);

            $result = $statement->fetchColumn();

            return $result;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Marque les messages comme lus dans une conversation.
     * @param int $conversationId : l'identifiant de la conversation.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @return void
     */
    public function markMessagesAsRead(int $conversationId, int $userId): void
    {
        try {
            $sql = "
                UPDATE messages 
                SET read_at = NOW() 
                WHERE conversation_id = :conversation_id 
                AND receiver_id = :user_id
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'conversation_id' => $conversationId,
                'user_id' => $userId
            ]);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère le nombre de messages non lus dans une conversation spécifique pour un utilisateur donné.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @param int $conversationId : l'identifiant de la conversation.
     * @return int : le nombre de messages non lus.
     */
    public function countUnreadMessagesInConversation(int $userId, int $conversationId): int
    {
        try {
            $sql = "
                SELECT COUNT(*) 
                FROM messages 
                WHERE receiver_id = :user_id 
                AND conversation_id = :conversation_id 
                AND read_at IS NULL
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'user_id' => $userId,
                'conversation_id' => $conversationId
            ]);

            $result = $statement->fetchColumn();

            return $result;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}
