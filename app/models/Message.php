<?php

/**
 * Classe qui représente un message.
 */
class Message
{
    private ?int $messageId;
    private ?int $conversationId;
    private ?int $senderId;
    private ?int $receiverId;
    private ?string $message;
    private ?string $sentAt;

    /**
     * Constructeur de la classe Message.
     * @param int|null $messageId : l'ID du message.
     * @param int|null $conversationId : l'ID de la conversation.
     * @param int|null $senderId : l'ID de l'utilisateur qui a envoyé le message.
     * @param int|null $receiverId : l'ID de l'utilisateur qui a reçu le message.
     * @param string|null $message : le contenu du message.
     * @param string|null $sentAt : la date et l'heure d'envoi du message.
     */
    public function __construct(
        int $messageId = null,
        int $conversationId = null,
        int $senderId = null,
        string $message = null,
        string $sentAt = null
    ) {
        $this->messageId = $messageId;
        $this->conversationId = $conversationId;
        $this->senderId = $senderId;
        $this->message = $message;
        $this->sentAt = $sentAt;
    }

    /**
     * Méthode statique qui crée et retourne un objet Message à partir des données fournies dans un tableau associatif.
     * Les clés du tableau associatif $array doivent correspondre aux noms des propriétés de l'objet Message.
     * @param array $array : tableau associatif contenant les données du message.
     * @return Message : objet Message.
     */
    public static function fromArray(array $array): Message
    {
        $message = new Message();
        $message->setMessageId($array['message_id'] ?? null);
        $message->setConversationId($array['conversation_id'] ?? null);
        $message->setSenderId($array['sender_id'] ?? null);
        $message->setReceiverId($array['receiver_id'] ?? null);
        $message->setMessage($array['message'] ?? null);
        $message->setSentAt($array['sent_at'] ?? null);

        return $message;
    }

    /**
     * Setter pour l'ID du message.
     * @param int|null $messageId : l'ID du message.
     * @return void
     */
    public function setMessageId(?int $messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * Getter pour l'ID du message.
     * @return int|null : l'ID du message.
     */
    public function getMessageId(): ?int
    {
        return $this->messageId;
    }

    /**
     * Setter pour l'ID de la conversation.
     * @param int|null $conversationId : l'ID de la conversation.
     * @return void
     */
    public function setConversationId(?int $conversationId): void
    {
        $this->conversationId = $conversationId;
    }

    /**
     * Getter pour l'ID de la conversation.
     * @return int|null : l'ID de la conversation.
     */
    public function getConversationId(): ?int
    {
        return $this->conversationId;
    }

    /**
     * Setter pour l'ID de l'utilisateur qui a envoyé le message.
     * @param int|null $senderId : l'ID de l'utilisateur.
     * @return void
     */
    public function setSenderId(?int $senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * Getter pour l'ID de l'utilisateur qui a envoyé le message.
     * @return int|null : l'ID de l'utilisateur.
     */
    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    /**
     * Setter pour l'ID de l'utilisateur qui a reçu le message.
     * @param int|null $senderId : l'ID de l'utilisateur.
     * @return void
     */
    public function setReceiverId(?int $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    /**
     * Getter pour l'ID de l'utilisateur qui a reçu le message.
     * @return int|null : l'ID de l'utilisateur.
     */
    public function getReceiverId(): ?int
    {
        return $this->receiverId;
    }

    /**
     * Setter pour le contenu du message.
     * @param string|null $message : le contenu du message.
     * @return void
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * Getter pour le contenu du message.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string|null : le contenu du message.
     */
    public function getMessage(int $length = -1): ?string
    {
        if ($length > 0) {
            $message = mb_substr($this->message, 0, $length);
            if (strlen($this->message) > $length) {
                $message .= "...";
            }
            return $message;
        }
        return $this->message;
    }

    /**
     * Setter pour la date et l'heure d'envoi du message.
     * @param string|null $sentAt : la date et l'heure d'envoi du message.
     * @return void
     */
    public function setSentAt(?string $sentAt): void
    {
        $this->sentAt = $sentAt;
    }

    /**
     * Getter pour l'heure de l'envoi du message.
     * @return string : l'heure au format HH:MM.
     */
    public function getSentTime(): string
    {
        // Récupération de l'heure uniquement
        return date('H:i', strtotime($this->sentAt));
    }

    /**
     * Getter pour la date et l'heure de l'envoi du message avec un format par défaut (jour, mois, heure).
     * @return string : la date et l'heure au format "d.m H:i".
     */
    public function getFormattedSentDateTime(): string
    {
        // Récupération de la date et de l'heure avec le format par défaut
        return date('d.m H:i', strtotime($this->sentAt));
    }
}
