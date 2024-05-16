<div class="connexion-wrapper">
    <div class="left-block">
        <h2><?php echo $action === "logInForm" ?  "Connection" : "Inscription" ?></h2>
        <form action="index.php?action=<?php echo $action === "logInForm" ?  "logIn" : "signIn" ?>" method="POST">
            <?php if ($action !== "logInForm") : ?>
            <div class="form-input">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" />
            </div>
            <?php endif; ?>
            <div class="form-input">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" />
            </div>
            <div class="form-input">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" minlength="3" />
            </div>
            <div class="form-input">
                <input type="submit" value="<?php echo $action === "logInForm" ?  "Se connecter" : "S'inscrire" ?>"
                    class="connexion-submit-button" />
            </div>
        </form>
        <p>
            <?php echo $action === "logInForm"
                ? "Pas de compte ? <a href='index.php?action=signInForm'>Inscrivez-vous</a>"
                : "Déjà inscrit ? <a href='index.php?action=logInForm'>Connectez-vous</a>";
            ?>
        </p>
        <p>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="alert-signIn-message">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']);
            }
            ?>
    </div>
    <div class="right-block">
        <img src="./img/connexion.png" alt="Une bibliothèque avec de nombreux livres">
    </div>
</div>