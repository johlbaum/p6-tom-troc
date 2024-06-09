<div class="mail-box-wrapper">
    <div class="mail-box-left-block">
        <div class="mail-box-left-block-content">
            <h1>Messagerie</h1>
            <?php if (isset($conversationsPreviews)) {
                foreach ($conversationsPreviews as $conversationPreview) {
                    $conversationPartnerPseudo = $conversationPreview['conversationPartnerPseudo'];
                    $lastMessage = $conversationPreview['lastMessage'];
                    $conversationPartnerId = $conversationPreview['conversationPartnerId'];
                    $unreadMessagesNumber = $conversationPreview['unreadMessagesNumber'];
                    $isSelected = ($lastMessage->getConversationId() == $conversationId);
            ?>
                    <a href="index.php?action=showMailBox&conversationId=<?= $lastMessage->getConversationId() ?>&receiverId=<?= $conversationPartnerId ?>">
                        <div class="recipient-profile <?php echo $isSelected ? 'selected' : ''; ?>">
                            <div class="recipient-profile-left-block">
                                <img src="./img/user-profile-img.png" alt="Image de profil du destinataire">
                                <?php if ($unreadMessagesNumber > 0) { ?> <div class="unread-messages-indicator">
                                        <?php echo $unreadMessagesNumber ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="recipient-profile-right-block">
                                <div class="bloc-pseudo-data">
                                    <p><?= $conversationPartnerPseudo ?></p>
                                    <p><?= $lastMessage->getSentTime() ?></p>
                                </div>
                                <div class="message-content">
                                    <p><?= $lastMessage->getMessage(26) ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php }
            }
            ?>
        </div>
    </div>
    <div class="mail-box-right-block">
        <?php if (!empty($conversation) || !empty($receiver)) { ?>
            <div class="recipient-profile">
                <?php if (!empty($receiver)) { ?>
                    <img src="./img/user-profile-img.png" alt="Image de profil du destinataire">
                    <p><?php echo $receiver->getPseudo() ?></p>
                <?php } ?>

            </div>
            <div class="messages-content">
                <?php if (isset($messages)) { ?>
                    <?php foreach ($messages as $message) { ?>
                        <div class="<?php echo $userConnectedId !== $message->getSenderId() ? "message-wrapper-recipient" : "message-wrapper-sender" ?>">
                            <div class="<?php echo $userConnectedId !== $message->getSenderId() ? "message-wrapper-recipient-date" : "message-wrapper-sender-date" ?>">
                                <img src="./img/user-profile-img.png" alt="Image de profil du destinataire">
                                <p><?php echo $message->getFormattedSentDateTime() ?></p>
                            </div>
                            <p class="<?php echo $userConnectedId !== $message->getSenderId() ? "message-recipient" : "message-sender" ?>">
                                <?= $message->getMessage(); ?>
                            </p>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <form action="index.php?action=sendMessage&receiverId=<?php echo $receiver->getId() ?>" method="POST" class="message-form">
                <div class="input-message-form">
                    <label for="message" class="visually-hidden">Tapez votre message</label>
                    <input type="text" name="message" placeholder="Tapez votre message ici" id="message">
                </div>
                <div class="input-message-button">
                    <label for="submit" class="visually-hidden">Envoyez votre message</label>
                    <input type="submit" value="Envoyer" id="submit">
                </div>
            </form>
        <?php } elseif (!empty($conversationsPreviews)) { ?>
            <div class="home-mail-box">
                <img src="./img/logo.svg" alt="Le logo de Tom troc">
                <p class="mail-box-indications">Clic sur une conversation pour l'afficher.</p>
            </div>
        <?php } else { ?>
            <div class="home-mail-box">
                <img src="./img/logo.svg" alt="Le logo de Tom troc">
                <p class="mail-box-indications">Il n'existe pas encore de conversations.</p>
            </div>
        <?php } ?>
    </div>
</div>