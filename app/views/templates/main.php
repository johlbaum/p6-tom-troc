<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="main-container">
        <header>
            <div class="logo">
                <img src="./img/logo.svg" alt="Le logo de Tom Troc" />
            </div>
            <?php $currentPage = $_GET['action']; ?>
            <nav>
                <ul class="left-menu">
                    <li <?php if ($currentPage === 'home') echo 'class="selected"'; ?>><a href="index.php?action=home">Accueil</a></li>
                    <li <?php if ($currentPage === 'ourBooks') echo 'class="selected"'; ?>><a href="index.php?action=ourBooks">Nos livres à l’échange</a></li>
                </ul>
                <ul class="right-menu">
                    <li class="<?php echo $currentPage === 'showMailBox' ? 'selected mail-box-item' : 'mail-box-item'; ?>">
                        <a href="index.php?action=showMailBox">
                            <img src="./img/message-icon.svg" alt="Icone de la messagerie" class="message-icon">
                            Messagerie
                            <?php if (isset($_SESSION['unreadMessagesCount']) && $_SESSION['unreadMessagesCount'] > 0) {
                                echo '<span class="unread-msg-count">' . $_SESSION['unreadMessagesCount'] . '</span>';
                            } ?>
                        </a>
                    </li>
                    <li <?php if ($currentPage === 'userDashboard') echo 'class="selected"'; ?>><a href="index.php?action=userDashboard">
                            <img src="./img/account-icon.svg" alt="Icone du compte" class="account-icon">
                            Mon compte</a>
                    </li>
                    <li>
                        <?php
                        if (isset($_SESSION['userEmail'])) {
                            echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                        } else {
                            echo '<a href="index.php?action=logInForm">Connexion</a>';
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </header>
        <?= $content ?>
        <footer>
            <ul>
                <li>Politique de confidentialité</li>
                <li>Mentions légales</li>
                <li>Tom Troc©</li>
                <li><img src="./img/logo-footer.svg" alt="Le logo de Tom Troc" /></li>
            </ul>
        </footer>
    </div>
</body>

</html>