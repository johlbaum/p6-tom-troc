<div class="user-profile-wrapper">
    <div class="user-profile-left-block">
        <div class="user-info-picture-profile">
            <img src="./img/user-profile-img.png" alt="Image de profil de l'utilisateur">
        </div>
        <hr />
        <div class="user-info">
            <p class="user-info__pseudo"><?= $user->getPseudo() ?></p>
            <p class="user-info__register-date">Membre depuis <?= $registrationDate ?></p>
            <p class="user-info__library-header">Bibliothèque</p>
            <div class="user-info__library-wrapper">
                <img src="./img/book-logo.svg" alt="Logo livres" class="user-info__library-logo">
                <p class="user-info__books-count"><?= count($books) ?> livres</p>
            </div>
            <div class="profile-send-message-button">
                <a href="index.php?action=showMailBox&receiverId=<?= $user->getId() ?>">
                    <p>Écrire un message</p>
                </a>
            </div>
        </div>
    </div>
    <div class="user-profile-right-block">
        <div class="user-books-table">
            <table>
                <thead>
                    <tr>
                        <th>photo</th>
                        <th>titre</th>
                        <th>auteur</th>
                        <th>description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rowCount = 0;
                    foreach ($books as $book) {
                        $rowCount++;
                    ?>
                        <tr class="<?= $rowCount % 2 === 0 ? 'even-row' : '' ?>">
                            <td><img src="./img/book-cover.jpg" alt="Couverture du livre" class="book-cover-dashboard"></td>
                            <td><?= $book->getTitle() ?></td>
                            <td><?= $book->getAuthor() ?></td>
                            <td><?= $book->getDescription(50) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>