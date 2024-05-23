<div class="detail-book-wrapper">
    <div class="detail-book-left-block">
        <img src="./img/book-cover.jpg" alt="La couverture du livre">
    </div>
    <div class="detail-book-right-block">
        <h1 class="detail-book-title"><?= $book->getTitle() ?></h1>
        <p class="detail-book-author"><?= $book->getAuthor() ?></p>
        <hr>
        <p class="detail-book-subtitle">Description</p>
        <p class="detail-book-description"><?= $book->getDescription() ?></p>
        <p class="detail-book-subtitle">Propriétaire</p>
        <div class="detail-book-owner-wrapper">
            <img src="./img/user-profile-img.png" alt="Image de profil du propriétaire du livre">
            <p><?= $book->getUserPseudo() ?></p>
        </div>
        <div class="detail-book-button-wrapper">
            <a href="">
                <button class="send-message-button">Envoyer un message</button>
            </a>
        </div>
    </div>
</div>