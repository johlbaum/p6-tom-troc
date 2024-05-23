<section class="hero-section">
    <div class="hero-left-block-wrapper">
        <h1 class="hero-left-block-title">Rejoignez nos lecteurs passionnés </h1>
        <p class="hero-left-block-content">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres
            amoureux de la lecture. Nous croyons en
            la magie du partage de connaissances et d'histoires à travers les livres. </p>
        <a href="index.php?action=ourBooks">
            <button class="hero-left-block-button">Découvrir</button>
        </a>
    </div>
    <div class="hero-right-block-wrapper">
        <img src="./img/banner.png" alt="Un homme entouré de livres">
        <p>Hamza</p>
    </div>
</section>
<section class="last-books-added-section">
    <h2 class="last-books-added-title">Les derniers livres ajoutés</h2>
    <div class="cards-wrapper">
        <?php
        foreach ($lastBooksAdded as $lastBookAdded) { ?>
            <a href="index.php?action=showBook&id=<?= $lastBookAdded->getId() ?>">
                <div class="card">
                    <img src="./img/book-cover.jpg" alt="" class="card-img">
                    <div class="card-content">
                        <p class="card-title"><?= $lastBookAdded->getTitle() ?></p>
                        <p class=" card-author"><?= $lastBookAdded->getAuthor() ?></p>
                        <p class="card-sell-by">Vendu par : <?= $lastBookAdded->getUserPseudo() ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="last-book-added-button-wrapper">
        <a href="index.php?action=ourBooks">
            <button class="last-books-added-button">Voir tous les livres</button>
        </a>
    </div>
</section>
<section class="how-it-works-section">
    <h2 class="how-it-works-title">Comment ça marche ?</h2>
    <p class="how-it-works-content">Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour
        commencer :</p>
    <div class="how-it-works-wrapper">
        <div class="how-it-works-step">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div class="how-it-works-step">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="how-it-works-step">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="how-it-works-step">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>
    <div class="how-it-works-button-wrapper">
        <a href="index.php?action=ourBooks">
            <button class="how-it-works-button">Voir tous les livres</button>
        </a>
    </div>
</section>
<section class="full-width-image">
    <img src="./img/full-width-image.png" alt="Une femme devant un bibliothèque">
</section>
<section class="our-values-section">
    <h2 class="our-values-title">Nos valeurs</h2>
    <p class="our-values-content">
        Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées
        dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la
        puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
    </p>
    <p class="our-values-content">
        Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
    </p>
    <p class="our-values-content">
        Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de
        partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
    </p>
    <div class="our-values-footer">
        <p class="our-values-crew">L’équipe Tom Troc</p>
        <img src="./img/logo-our-values.svg" alt="Un logo en forme de coeur">
    </div>
</section>