<?php


?>

<div class="dashboard-wrapper">
    <h2>Mon compte</h2>
    <div class="user-info-wrapper">
        <div class="user-info-wrapper-left">
            <div class="user-info-picture-profile">
                <img src="./img/profile.png" alt="Image de profile générique" />
                <p>modifier</p>
            </div>
            <hr />
            <div class="user-main-info">
                <p class="user-main-info-lastname">Prénom</p>
                <p class="user-main-info-register-date">Membre depuis 1 an</p>
                <p class="user-main-info-books-header">Bibliothèque</p>
                <p class="user-main-info-books-number">4 livres</p>
            </div>
        </div>
        <div class="user-info-wrapper-right">
            <h3>Vos informations personnelles</h3>
            <form action=""">
                <div class=" dashbord-form-input">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" autocomplete="new-email" />
        </div>
        <div class="dashbord-form-input">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" minlength="3" autocomplete="new-password" />
        </div>
        <div class="dashbord-form-input">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" autocomplete="off" />
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