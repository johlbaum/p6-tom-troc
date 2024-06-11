<?php

require_once '../app/models/BookManager.php';
require_once '../app/models/UserManager.php';
require_once '../app/views/View.php';
require_once '../app/services/Utils.php';
require_once '../app/services/UserService.php';

/**
 * Contrôleur qui gère l'espace administrateur et les pages et les opérations qui nécessitent 
 * d'être connecté pour y accéder.
 */
class UserAdminController
{
    private UserManager $userManager;
    private BookManager $bookManager;
    private UserService $userService;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->bookManager = new BookManager();
        $this->userService = new UserService();
    }

    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showUserDashboard(): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        //On récupère l'id et l'email de l'utilisateur connecté.
        $userId = $_SESSION['userId'];
        $userEmail = $_SESSION['userEmail'];

        // On récupère les informations de l'utilisateur.
        $user = $this->userManager->getUserByEmail($userEmail);

        // On récupère les livres ajoutés par l'utilisateur.
        $booksByUser = $this->bookManager->getAllBooksByUser($userId);

        // On récupère la date d'inscription de l'utilisateur.
        $registrationDate = $this->userService->getUserRegistrationDate($userId);

        $view = new View('Espace administrateur');
        $view->render("userDashboard", [
            'user' => $user,
            'books' => $booksByUser,
            'registrationDate' => $registrationDate
        ]);
    }

    /**
     * Met à jour les données de l'utilisateur.
     * @return void
     */
    public function updateUserProfile(): void
    {
        // On vérifie que les champs ne soient pas vides.
        if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            // On vérifie le format de l'adresse email.
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Le format de l'email n'est pas valide.";
        } else {
            // On convertit les caractères spéciaux.
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // On crypte le mot de passe
            $cryptPassword = password_hash($password, PASSWORD_DEFAULT);

            // On récupère l'id de l'utilisateur.
            $userId = $_SESSION['userId'];

            // On enregistre l'utilisateur dans la base de données.
            $success = $this->userManager->updateUserProfile($userId, $pseudo, $email, $cryptPassword);

            // On envoie un message de confirmation de mise à jour de compte ou d'erreur à l'utilisateur.
            if ($success) {
                $_SESSION['userEmail'] = $email;
                $_SESSION['message'] = "Votre compte a été mis à jour avec succès.";
            } else {
                $_SESSION['message'] = "Une erreur s'est produite lors de la mise à jour de votre compte.";
            }
        }

        header("Location: index.php?action=userDashboard");
        exit;
    }

    /**
     * Affiche le formulaire d'ajout ou de mise à jour d'un livre.
     * @return void
     */
    public function displayBookForm($action): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        $book = null;

        // Si l'utilisateur souhaite mettre à jour un livre, l'URL contiendra un paramètre id.
        // On récupère l'id du livre à modifier dans l'URL s'il existe.
        if (!empty($_GET['id'])) {
            $bookId = $_GET['id'];
            // On récupère l'objet Book correspondant à cet id et on le stocke dans la variable $book.
            $book = $this->bookManager->getBookById($bookId);
        }

        // Si le livre n'a pas été trouvé (l'utilisateur souhaite ajouter un nouveau livre), on crée un objet Book vide.
        if (!$book) {
            $book = Book::fromArray([]);
        }

        // On définit le titre de la page en fonction du paramètre $action récupéré dans l'URL.
        $pageTitle = $action === "addBookForm" ? "Ajouter un livre" : "Modifier un livre";

        $view = new View($pageTitle);
        $view->render("bookForm", [
            'action' => $action,
            'book' => $book //Un objet Book qui contiendra soit les propriétés du livres à mettre à jour, soit un objet vide.
        ]);
    }

    /**
     * Méthode qui permet d'ajouter ou de modifier un livre.
     * @return void
     */
    public function addOrUpdateBook(): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // On récupère l'id du livre à modifier, s'il existe.
        $bookId = !empty($_GET['id']) ? $_GET['id'] : null;

        // On vérifie si tous les champs nécessaires sont remplis.
        if (
            empty($_POST['book-title']) ||
            empty($_POST['book-author']) ||
            empty($_POST['book-description']) ||
            empty($_POST['book-availability'])
        ) {
            $this->redirectToFormWithMessage($bookId, "Veuillez remplir tous les champs.");
        }

        // On récupère l'id de l'utilisateur.
        $userId = $_SESSION['userId'];

        // On échappe les caractères spéciaux.
        $bookTitle = htmlspecialchars($_POST['book-title']);
        $bookAuthor = htmlspecialchars($_POST['book-author']);
        $bookDescription = htmlspecialchars($_POST['book-description']);
        $bookAvailability = htmlspecialchars($_POST['book-availability']);

        // On crée l'objet Book.
        $book = Book::fromArray([
            'id' => $bookId, // id sera null si aucun paramètre id n'est trouvé dans l'URL (dans le cas de l'ajout d'un nouveau livre).
            'user_id' => $userId,
            'title' => $bookTitle,
            'author' => $bookAuthor,
            'description' => $bookDescription,
            'availability' => $bookAvailability
        ]);

        // On ajoute ou met à jour le livre.
        $this->bookManager->addOrUpdateBook($book);

        // On redirige vers le tableau de bord de l'utilisateur.
        header("Location: index.php?action=userDashboard");
        exit;
    }

    /**
     * Méthode qui redirige l'utilisateur vers le formulaire approprié (ajout ou édition) avec un message d'erreur.
     * @param string|null $bookId : l'ID du livre à modifier, ou null si on ajoute un nouveau livre.
     * @param string $message : le message d'erreur à afficher à l'utilisateur.
     */
    private function redirectToFormWithMessage(?string $bookId, string $message): void
    {
        $_SESSION['message'] = $message;
        $action = $bookId ? "editBookForm" : "addBookForm";
        header("Location: index.php?action=$action");
        exit;
    }

    /**
     * Suppression d'un livre.
     * @return void
     */
    public function deleteBook(): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // On récupère l'id du livre à supprimer.
        $bookId = $_GET['id'];

        // On supprime le livre.
        $this->bookManager->deleteBook($bookId);

        header("Location: index.php?action=userDashboard");
        exit;
    }

    /**
     * Affiche la page de profile d'un utilisateur.
     * @return void
     */
    public function showProfile(): void
    {
        // On vérifie si l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // On récupère l'id de l'utilisateur.
        $userId = $_GET['id'];

        // On récupère les informations de l'utilisateur.
        $user = $this->userManager->getUserById($userId);

        // On récupère les livres ajoutés par l'utilisateur.
        $booksByUser = $this->bookManager->getAllBooksByUser($userId);

        // On récupère la date d'inscription de l'utilisateur.
        $registrationDate = $this->userService->getUserRegistrationDate($userId);

        $view = new View("Profile de " . $user->getPseudo());
        $view->render("userProfile", [
            'user' => $user,
            'books' => $booksByUser,
            'registrationDate' => $registrationDate
        ]);
    }
}
