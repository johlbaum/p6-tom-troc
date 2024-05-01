<?php

require_once('../config/config.php');
require_once('../app/controllers/BookController.php');
require_once('../app/controllers/UserAccessController.php');
require_once('../app/views/View.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

try {
    switch ($action) {
        case 'home':
            $bookController = new BookControler();
            $bookController->showHome();
            break;
        case 'logInForm':
            $userAccessController = new UserAccessController();
            $userAccessController->displayUserAccessForm($action);
            break;
        case 'signInForm':
            $userAccessController = new UserAccessController();
            $userAccessController->displayUserAccessForm($action);
            break;
        default:
            throw new Exception("Action non valide : $action");
            break;
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render("errorPage");
}
