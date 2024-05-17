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
                <?php if ($user->getProfileImage() !== null) : ?>
                    <!-- Affiche l'image de profil de l'utilisateur -->
                    <img src="<?php echo $user->getProfileImage(); ?>" alt="Profile Image">
                <?php else : ?>
                    <!-- Affiche l'image par défaut si l'utilisateur n'a pas renseigné d'image de profil -->
                    <img src="./img/default-profile-img.png" alt="Default Profile Image">
                <?php endif; ?>
                <form action="index.php?action=updateUserProfileImage" method="POST" enctype="multipart/form-data">
                    <input type="file" name="profile-image" id="image">
                    <input type="submit" value="modifier" name="submit">
                </form>
            </div>
            <hr />
            <div class="user-main-info">
                <p class="user-main-info-lastname"><?= $user->getPseudo() ?></p>
                <p class="user-main-info-register-date">Membre depuis 1 an</p>
                <p class="user-main-info-books-header">Bibliothèque</p>
                <p class="user-main-info-books-number">4 livres</p>
            </div>
        </div>
        <div class="user-info-wrapper-right">
            <h3>Vos informations personnelles</h3>
            <form action="index.php?action=updateUserProfile" method="POST">
                <div class=" dashbord-form-input">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" autocomplete="new-email" value="<?= $user->getEmail() ?>" />
                </div>
                <div class="dashbord-form-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" minlength="3" autocomplete="new-password" value="<?= substr($user->getPassword(), 0, 10) ?>" />
                </div>
                <div class=" dashbord-form-input">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" autocomplete="off" value="<?= $user->getPseudo() ?>" />
                </div>
                <div class="dashboard-form-input">
                    <input type="submit" value="Enregistrer" />
                </div>
            </form>
        </div>
    </div>
    <div class="user-articles-wrapper">
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
                <tr>
                    <td>Contenu de la colonne PHOTO</td>
                    <td>Contenu de la colonne TITRE</td>
                    <td>Contenu de la colonne AUTEUR</td>
                    <td>Contenu de la colonne DESCRIPTION</td>
                    <td>Contenu de la colonne DISPONIBILITE</td>
                    <td>Contenu de la colonne ACTION</td>
                </tr>
                <tr>
                    <td>Contenu de la colonne PHOTO</td>
                    <td>Contenu de la colonne TITRE</td>
                    <td>Contenu de la colonne AUTEUR</td>
                    <td>Contenu de la colonne DESCRIPTION</td>
                    <td>Contenu de la colonne DISPONIBILITE</td>
                    <td>Contenu de la colonne ACTION</td>
                </tr>
                <tr>
                    <td>Contenu de la colonne PHOTO</td>
                    <td>Contenu de la colonne TITRE</td>
                    <td>Contenu de la colonne AUTEUR</td>
                    <td>Contenu de la colonne DESCRIPTION</td>
                    <td>Contenu de la colonne DISPONIBILITE</td>
                    <td>Contenu de la colonne ACTION</td>
                </tr>
                <tr>
                    <td>Contenu de la colonne PHOTO</td>
                    <td>Contenu de la colonne TITRE</td>
                    <td>Contenu de la colonne AUTEUR</td>
                    <td>Contenu de la colonne DESCRIPTION</td>
                    <td>Contenu de la colonne DISPONIBILITE</td>
                    <td>Contenu de la colonne ACTION</td>
                </tr>
            </tbody>
        </table>
    </div>