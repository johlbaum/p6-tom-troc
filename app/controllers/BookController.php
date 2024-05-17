<?php

require_once('../app/views/View.php');

class BookControler
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
}
