<?php

require_once('../app/views/View.php');

class BookControler
{
    public function showHome(): void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
}
