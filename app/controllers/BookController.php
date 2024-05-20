<?php

require_once('../app/views/View.php');
require_once('../app/models/BookManager.php');

class BookControler
{
    /**
     * Affiche la page d'accueil avec les derniers livres ajoutés.
     * @return void
     */
    public function showHome(): void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
}
