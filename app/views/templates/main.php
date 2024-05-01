<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="main-container">
        <header>
            <div class="logo">
                <a href="index.php?action=home">
                    <img src="./img/logo.svg" alt="Le logo de Tom Troc" />
                </a>
            </div>
            <nav>
                <ul class="left-menu">
                    <li><a href="index.php?action=home">Accueil</a></li>
                    <li><a href="#">Nos livres à l’échange</a></li>
                </ul>
                <ul class="right-menu">
                    <li><a href="#">Messagerie</a></li>
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="index.php?action=logInForm">Connexion</a></li>
                </ul>
            </nav>
        </header>
        <?= $content ?>
        <p>Footer</p>
    </div>
</body>

</html>