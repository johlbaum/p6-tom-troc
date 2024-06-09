<?php

require_once '../app/views/View.php';
require_once '../app/models/UserManager.php';
require_once '../app/models/ConversationManager.php';
require_once '../app/services/MailBoxService.php';
require_once '../app/services/Utils.php';

/**
 * Classe qui gère les actions liées à la messagerie.
 */
class MailBoxController
{
    private MailBoxService $mailBoxService;
    private ?int $userConnectedId;

    public function __construct()
    {
        $conversationManager = new ConversationManager();
        $userManager = new UserManager();
        $this->mailBoxService = new MailBoxService($conversationManager, $userManager);
        $this->userConnectedId = $_SESSION['userId'] ?? null;
    }

    /**
     * Affiche la boîte de réception de l'utilisateur connecté.
     */
    public function showMailBox(): void
    {
        // On vérifie que l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // On initialise les variables.
        $conversationId = null;
        $messages = null;
        $conversationsPreviews = [];
        $receiverId = null;

        // On récupère les IDs de toutes les conversations de l'utilisateur connecté.
        $conversationsIds = $this->mailBoxService->getUserConversationsIds($this->userConnectedId);

        // On récupère le nombre de messages non lus de toutes les conversations et on le stocke dans la session.
        $this->mailBoxService->countUnreadMessagesForUser($this->userConnectedId);

        // Si l'utilisateur connecté a déjà engagé des conversations avec d'autres utilisateurs :
        if ($conversationsIds) {

            // On récupère pour toutes les conversations les détails du dernier message envoyé (bloc de gauche de la messagerie).
            $conversationsPreviews = $this->mailBoxService->getConversationsPreviews($conversationsIds, $this->userConnectedId);

            // Si l'utilisateur souhaite afficher et éventuellement poursuivre une précédente conversation dans sa messagerie.
            if (isset($_GET['conversationId'])) {
                $conversationId = intval($_GET['conversationId']);

                // On récupère le nombre de messages non lus de la conversation.
                $this->mailBoxService->countUnreadMessagesInConversation($this->userConnectedId, $conversationId);

                // On récupère tous les messages de la conversation.
                $messages = $this->mailBoxService->getMessagesByConversationId($conversationId);

                // On indique comme lus les messages de la conversation.
                $this->mailBoxService->markMessagesAsRead($conversationId, $this->userConnectedId);

                // On rafraîchit la session après avoir marqué comme lus les messages de la conversation.
                $this->mailBoxService->countUnreadMessagesForUser($this->userConnectedId);

                // On rafraîchit les données après avoir marqué comme lus les messages de la conversation.
                $conversationsPreviews = $this->mailBoxService->getConversationsPreviews($conversationsIds, $this->userConnectedId);

                // On récupère l'id du destinataire du prochain message à envoyer.
                $receiverId = $this->mailBoxService->getReceiverIdFromConversation($this->userConnectedId, $conversationId);
            }

            // Si l'utilisateur souhaite commencer ou poursuivre une conversation avec un utilisateur spécifique en passant
            // par son profil ou l'onglet "Nos livres à l'échange ".
            if (isset($_GET['receiverId'])) {
                $receiverId = intval($_GET['receiverId']);

                // On récupère les messages de la conversation précédente si elle existe.
                $conversationId = $this->mailBoxService->getConversationId($this->userConnectedId, $receiverId);
                if (!empty($conversationId)) {
                    $messages = $this->mailBoxService->getMessagesByConversationId($conversationId);
                }
            }

            // On récupère l'utilisateur avec qui la conversation est engagée.
            $receiver = $this->mailBoxService->getReceiver(intval($receiverId));

            $view = new View("mailBox");
            $view->render("mailBox", [
                'conversationsPreviews' => $conversationsPreviews,
                'messages' => $messages,
                'receiver' => $receiver,
                'userConnectedId' => $this->userConnectedId,
                'conversationId' => $conversationId
            ]);
        } else {
            // Si l'utilisateur connecté n'a pas encore engagé de conversations :
            if (isset($_GET['receiverId'])) {  // Il souhaite engager une conversation avec un autre utilisateur.
                $receiverId = $_GET['receiverId'];
                $receiver = $this->mailBoxService->getReceiver(intval($receiverId));

                $view = new View("mailBox");
                $view->render("mailBox", [
                    'receiver' => $receiver
                ]);
            } else {  // Il souhaite ouvrir sa messagerie.
                $view = new View("mailBox");
                $view->render("mailBox");
            }
        }
    }

    /**
     * Envoie un message.
     */
    public function sendMessage(): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        $this->mailBoxService->sendMessage();
    }
}
