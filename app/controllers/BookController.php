<?php

require_once('../app/views/View.php');
require_once('../app/models/BookManager.php');

/**
 * Contrôleur qui gère les opérations relatives aux livres : afficher la page d'accueil avec les
 * derniers livres ajoutés, la liste des livres disponibles à l'échange, le détail d'un livre
 * et les résultats de recherche basés sur le titre du livre.
 * Ces opérations ne nécessitent pas que l'utilisateur soit connecté.
 */
class BookControler
{
    private BookManager $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
    }

    /**
     * Affiche la page d'accueil avec les derniers livres ajoutés.
     * @return void
     */
    public function showHome(): void
    {
        $lastBooksAdded = $this->bookManager->lastBooksAdded();

        $view = new View("Accueil");
        $view->render("home", [
            'lastBooksAdded' => $lastBooksAdded
        ]);
    }

    /**
     * Affiche la page "Nos livres à l'échange".
     * @return void
     */
    public function showOurBooks(): void
    {
        $books = $this->bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("ourBooks", [
            'books' => $books
        ]);
    }

    /**
     * Affiche le détail d'un livre.
     * @return void
     */
    public function showBook(): void
    {
        $bookId = $_GET['bookId'];

        $book = $this->bookManager->getBookById($bookId);

        $view = new View($book->getTitle());
        $view->render("detailBook", [
            'book' => $book
        ]);
    }

    /**
     * Affiche les résultats de recherche d'un livre par son titre.
     * @return void
     */
    public function showSearchBooksResult(): void
    {
        // On récupère la valeur de recherche.
        $searchValue = $_POST['search-value'];

        // On vérifie si la valeur de recherche est vide.
        if (empty($searchValue)) {
            $_SESSION['message'] = "Veuillez indiquer un critère de recherche.";
            header("Location: index.php?action=ourBooks");
            exit;
        }

        // On convertit les caractères spéciaux de la recherche.
        $searchValue = htmlspecialchars($searchValue);

        // On effectue la recherche.
        $books = $this->bookManager->searchBooks($searchValue);

        // On affiche un message si aucun livre n'est trouvé.
        if (empty($books)) {
            $_SESSION['message'] = "Aucun livre ne correspond à votre recherche.";
        }

        $view = new View("Nos livres à l'échange");
        $view->render("ourBooks", [
            'books' => $books
        ]);
    }
}
