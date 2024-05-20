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
        $bookManager = new BookManager();
        $lastBooksAdded = $bookManager->lastBooksAdded();

        $view = new View("Accueil");
        $view->render("home", [
            'lastBooksAdded' => $lastBooksAdded
        ]);
    }

    /**
     * Affiche la page "Nos livres à l'échange"
     * @return void
     */
    public function showOurBooks(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("ourBooks", [
            'books' => $books
        ]);
    }
}
