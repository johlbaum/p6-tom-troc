<?php

require_once('../config/config.php');
require_once('../app/controllers/BookController.php');
require_once('../app/controllers/UserAccessController.php');
require_once('../app/controllers/UserAdminController.php');
require_once('../app/views/View.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

try {
    switch ($action) {
        case 'home':
            $bookController = new BookControler();
            $bookController->showHome();
            break;
        case 'ourBooks';
            $bookController = new BookControler();
            $bookController->showOurBooks();
            break;
        case 'showBook';
            $bookController = new BookControler();
            $bookController->showBook();
            break;
        case 'logInForm':
            $userAccessController = new UserAccessController();
            $userAccessController->displayUserAccessForm($action);
            break;
        case 'signInForm':
            $userAccessController = new UserAccessController();
            $userAccessController->displayUserAccessForm($action);
            break;
        case 'signIn';
            $userAccessController = new UserAccessController();
            $userAccessController->signInUser();
            break;
        case 'logIn';
            $userAccessController = new UserAccessController();
            $userAccessController->logInUser();
            break;
        case 'disconnectUser':
            $userAccessController = new UserAccessController();
            $userAccessController->disconnectUser();
            break;
        case 'userDashboard';
            $userAdminController = new UserAdminController();
            $userAdminController->showUserDashboard();
            break;
        case 'updateUserProfile';
            $userAdminController = new UserAdminController();
            $userAdminController->updateUserProfile();
            break;
        case 'addBookForm';
            $userAdminController = new UserAdminController();
            $userAdminController->displayBookForm($action);
            break;
        case 'editBookForm';
            $userAdminController = new UserAdminController();
            $userAdminController->displayBookForm($action);
            break;
        case 'manageBook'; //Ajouter ou modifier un livre.
            $userAdminController = new UserAdminController();
            $userAdminController->addOrUpdateBook();
            break;
        case 'deleteBook';
            $userAdminController = new UserAdminController();
            $userAdminController->deleteBook();
            break;
        case 'userProfile';
            $userController = new UserAdminController();
            $userController->showProfile();
            break;
        default:
            throw new Exception("Action non valide : $action");
            break;
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render("errorPage");
}
