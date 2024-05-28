<div class="our-books-wrapper">
    <div class="our-books-header">
        <h1>Nos livres à l’échange</h1>
        <form action="index.php?action=searchBooks" method="POST">
            <div class="search-input-wrapper">
                <img src="./img/search-icon.png" alt="Icône de recherche">
                <input type="text" name="search-value" placeholder="Rechercher un livre">
            </div>
            <input type="submit" value="Valider" class="our-books-submit-button" />
        </form>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="alert-message">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <div class="cards-wrapper">
        <?php
        foreach ($books as $book) { ?>
            <a href="index.php?action=showBook&id=<?= $book->getId() ?>">
                <div class="card">
                    <img src="./img/book-cover.jpg" alt="" class="card-img">
                    <div class="card-content">
                        <p class="card-title"><?= $book->getTitle() ?></p>
                        <p class="card-author"><?= $book->getAuthor() ?></p>
                        <p class="card-sell-by">Vendu par : <?= $book->getUserPseudo() ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>