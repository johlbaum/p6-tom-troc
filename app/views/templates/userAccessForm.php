<div class="connexion-wrapper">
    <div class="left-block">
        <h2><?php echo $action === "logInForm" ?  "Connection" : "Inscription" ?></h2>
        <form action="" method="get">
            <div class="form-input">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" required />
            </div>
            <div class="form-input">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required />
            </div>
            <div class="form-input">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" minlength="3" required />
            </div>
            <div class="form-input">
                <input type="submit" value="<?php echo $action === "logInForm" ?  "Se connecter" : "S'inscrire" ?>" class="connexion-submit-button" />
            </div>
        </form>
        <p>
            <?php echo $action === "logInForm"
                ? "Pas de compte ? <a href='index.php?action=signInForm'>Inscrivez-vous</a>"
                : "Déjà inscrit ? <a href='index.php?action=logInForm'>Connectez-vous</a>";
            ?>
        </p>

        </p>
    </div>
    <div class="right-block">
        <img src="./img/connexion.png" alt="Une bibliothèque avec de nombreux livres">
    </div>
</div>