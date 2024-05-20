<div class="dashboard-wrapper">
    <h2>Mon compte</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="alert-update-profile-message">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <div class="user-info-wrapper">
        <div class="user-info-wrapper-left">
            <div class="user-info-picture-profile">
                <img src="./img/user-profile-img.png" alt="Image de profil de l'utilisateur">
                <p>Modifier</p>
            </div>
            <hr />
            <div class="user-info">
                <p class="user-info__pseudo"><?= $user->getPseudo() ?></p>
                <p class="user-info__register-date">Membre depuis 1 an</p>
                <p class="user-info__library-header">Bibliothèque</p>
                <div class="user-info__library-wrapper">
                    <img src="./img/book-logo.svg" alt="Logo livres" class="user-info__library-logo">
                    <p class="user-info__books-count">4 livres</p>
                </div>
            </div>
        </div>
        <div class="user-info-wrapper-right">
            <h3>Vos informations personnelles</h3>
            <form action="index.php?action=updateUserProfile" method="POST">
                <div class="dashboard-form-input">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" autocomplete="new-email" value="<?= $user->getEmail() ?>" />
                </div>
                <div class="dashboard-form-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" minlength="3" autocomplete="new-password" value="<?= substr($user->getPassword(), 0, 10) ?>" />
                </div>
                <div class="dashboard-form-input">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" autocomplete="off" value="<?= $user->getPseudo() ?>" />
                </div>
                <input type="submit" value="Enregistrer" class="dashboard-form-submit" />
            </form>
        </div>
    </div>
    <div class="user-books-table">
        <table>
            <thead>
                <tr>
                    <th>photo</th>
                    <th>titre</th>
                    <th>auteur</th>
                    <th>description</th>
                    <th>disponibilité</th>
                    <th>action</th>
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
                        <td><?= $user->getPseudo() ?></td>
                        <td><?= $book->getDescription() ?></td>
                        <td>
                            <p class="<?= $book->getAvailability() === "disponible" ? "available-book" : "unavailable-book" ?>">
                                <?= $book->getAvailability() ?></p>
                        </td>
                        <td>
                            <a href="index.php?action=editBookForm&id=<?php echo $book->getId() ?>"><span class="book-edit-button">Éditer</span></a>
                            <a href="index.php?action=deleteBook&id=<?php echo $book->getId() ?>"><span class="book-delete-button">Supprimer</span></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="add-book-button">
        <a href="index.php?action=addBookForm">
            <button>Ajouter</button>
        </a>
    </div>
</div>