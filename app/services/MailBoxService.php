<?php

require_once '../app/models/UserManager.php';

/**
 * Classe qui gère les services de la messagerie.
 */
class MailBoxService
{
    private ConversationManager $conversationManager;
    private UserManager $userManager;

    /**
     * Constructeur de la classe MailBoxService.
     * @param ConversationManager $conversationManager : le gestionnaire de conversations.
     * @param UserManager $userManager : le gestionnaire d'utilisateurs.
     */
    public function __construct(ConversationManager $conversationManager, UserManager $userManager)
    {
        $this->conversationManager = $conversationManager;
        $this->userManager = $userManager;
    }

    /**
     * Récupère les identifiants des conversations de l'utilisateur connecté.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @return array : un tableau d'identifiants de conversations.
     */
    public function getUserConversationsIds(int $userConnectedId): array
    {
        return $this->conversationManager->getUserConversationsIds($userConnectedId);
    }

    /**
     * Récupère les messages d'une conversation par son identifiant.
     * @param int $conversationId : l'identifiant de la conversation.
     * @return array : un tableau de messages.
     */
    public function getMessagesByConversationId(int $conversationId)
    {
        return $this->conversationManager->getMessagesByConversationId($conversationId);
    }

    /**
     * Récupère l'identifiant d'une conversation entre l'utilisateur connecté et un autre utilisateur.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @param int $receiverId : l'identifiant de l'autre utilisateur.
     * @return ?int : l'identifiant de la conversation, ou null si elle n'existe pas.
     */
    public function getConversationId(int $userConnectedId, int $receiverId): ?int
    {
        return $this->conversationManager->getConversationId($userConnectedId, $receiverId);
    }

    /**
     * Récupère l'identifiant du destinataire du prochain message à envoyer dans une conversation.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @param int $conversationId : l'identifiant de la conversation.
     * @return int : l'identifiant du destinataire.
     */
    public function getReceiverIdFromConversation(int $userConnectedId, int $conversationId): int
    {
        $messages = $this->conversationManager->getMessagesByConversationId($conversationId);
        $lastMessage = end($messages);

        return $lastMessage->getSenderId() !== $userConnectedId ? $lastMessage->getSenderId() : $lastMessage->getReceiverId();
    }

    /**
     * Récupère les informations d'un utilisateur par son identifiant.
     * @param int $receiverId : l'identifiant de l'utilisateur.
     * @return ?User : l'objet utilisateur correspondant à l'identifiant, ou null si il n'existe pas.
     */
    public function getReceiver(int $receiverId): ?User
    {
        return $this->userManager->getUserById($receiverId);
    }

    /**
     * Récupère pour toutes les conversations les détails du dernier message envoyé.
     * @param array $conversationIds : un tableau d'identifiants de conversations.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @return array : un tableau de conversations.
     */
    public function getconversationsPreviews(array $conversationIds, int $userConnectedId): array
    {
        $conversationsPreviews = [];

        // On récupère les derniers messages de chaque conversation.
        $lastMessages = $this->conversationManager->getLastMessagesByConversationIds($conversationIds);

        foreach ($lastMessages as $lastMessage) {
            // On récupère le l'id de l'utilisateur du dernier message avec lequel l'utilisateur connecté a conversé.
            $conversationPartnerId = $lastMessage->getSenderId() !== $userConnectedId ? $lastMessage->getSenderId() : $lastMessage->getReceiverId();

            // On récupère le pseudo de l'utilisateur du dernier message avec lequel l'utilisateur connecté a conversé.
            $conversationPartner = $this->userManager->getUserById($conversationPartnerId);
            $conversationPartnerPseudo = $conversationPartner->getPseudo();

            // On récupère le nombre de messages non lus de l'utilisateur connecté.
            $conversationId = $lastMessage->getConversationId();
            $unreadMessagesNumber = $this->countUnreadMessagesInConversation($userConnectedId, $conversationId);

            $conversationsPreviews[] = [
                'lastMessage' => $lastMessage,
                'conversationPartnerPseudo' => $conversationPartnerPseudo,
                'conversationPartnerId' => $conversationPartnerId,
                'unreadMessagesNumber' => $unreadMessagesNumber
            ];
        }

        return $conversationsPreviews;
    }

    /**
     * Envoie un message à un utilisateur.
     * @return void
     */
    public function sendMessage(): void
    {
        $receiverId = intval($_GET['receiverId']);
        $userConnectedId = $_SESSION['userId'];
        $message = htmlspecialchars($_POST['message']);

        $conversationId = $this->conversationManager->checkOrCreateConversation($receiverId, $userConnectedId);

        $this->conversationManager->insertMessage($conversationId, $userConnectedId, $receiverId, $message);

        header("Location: index.php?action=showMailBox&receiverId=" . $receiverId);
        exit();
    }

    /**
     * Récupère le nombre de messages non lus pour un utilisateur connecté.
     * @param int $userConnectedId : l'identifiant de l'utilisateur connecté.
     * @return void
     */
    public function countUnreadMessagesForUser(int $userConnectedId): void
    {
        $unreadMessagesCount = $this->conversationManager->countUnreadMessagesForUser($userConnectedId);

        $_SESSION['unreadMessagesCount'] = $unreadMessagesCount;
    }

    /**
     * Marque les messages d'une conversation comme lus pour un utilisateur.
     * @param int $conversationId : l'identifiant de la conversation.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @return void
     */
    public function markMessagesAsRead(int $conversationId, int $userId): void
    {
        $this->conversationManager->markMessagesAsRead($conversationId, $userId);
    }

    /**
     * Récupère le nombre de messages non lus dans une conversation pour un utilisateur.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @param int $conversationId : l'identifiant de la conversation.
     * @return int : le nombre de messages non lus dans la conversation.
     */
    public function countUnreadMessagesInConversation(int $userId, int $conversationId): int
    {
        return $this->conversationManager->countUnreadMessagesInConversation($userId, $conversationId);
    }
}
