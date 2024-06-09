<?php

/** 
 * Template du formulaire d'ajout ou de mise à jour d'un livre.
 * Dans le cas de l'ajout d'un nouveau livre, toutes les propriétés de l'objet Book sont nulles. 
 * Dans le cas de la mise à jour d'un livre, l'objet Book contient toutes les propriétés du livre à modifier.
 */
?>

<div class="add-book-wrapper">
    <div class="add-book-back-link">
        <a href="index.php?action=userDashboard">
            &larr; retour
        </a>
    </div>
    <h1>
        <?php echo $action === "addBookForm" ? "Ajouter un livre" : "Modifier les informations"; ?>
    </h1>
    <div class="add-book-form-wrapper">
        <div class="add-book-form-left-block">
            <p>Photo</p>
            <img src="./img/book-cover.jpg" alt="Couverture de livre à ajouter">
            <p>Modifier la photo</p>
        </div>
        <div class="add-book-form-right-block">
            <!-- Ajout d'un paramètre id à l'URL pour permettre la mise à jour d'un livre. -->
            <form action="index.php?action=manageBook<?php if ($book->getId()) {
                                                            echo '&id=' . $book->getId();
                                                        } ?>" method="POST">
                <div class="add-book-form-input">
                    <label for="title">Titre</label>
                    <input type="text" name="book-title" id="title" autocomplete="new-title" value="<?php echo $book->getTitle() ?>" />
                </div>
                <div class="add-book-form-input">
                    <label for="author">Auteur</label>
                    <input type="text" name="book-author" id="author" autocomplete="new-author" value="<?php echo $book->getAuthor() ?>" />
                </div>
                <div class="add-book-form-input">
                    <label for="description">Commentaire</label>
                    <textarea name="book-description" id="description" autocomplete="off"><?php echo $book->getDescription(); ?></textarea>
                </div>
                <div class=" add-book-form-input">
                    <label for="availability">Disponibilité</label>
                    <select name="book-availability" id="availability">
                        <option value=""></option>
                        <option value="disponible" <?php echo $book->getAvailability() === 'disponible' ? 'selected' : ''; ?>>disponible
                        </option>
                        <option value="non dispo." <?php echo $book->getAvailability() === 'non dispo.' ? 'selected' : ''; ?>>non dispo.
                        </option>
                    </select>
                </div>
                <input type="submit" value="Valider" class="submit-button" />
            </form>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="alert-message">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']);
            }
            ?>
        </div>
    </div>
</div>