<?php
class Utils
{
    /**
     * Vérifie que l'utilisateur est connecté. 
     * @return void
     */
    public static function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['userEmail'])) {
            // Si l'utilisateur n'est pas connecté, on stocke l'URL actuelle dans la session
            // pour pouvoir rediriger l'utilisateur vers cette page une fois connecté.
            $_SESSION['redirectUrl'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?action=logInForm");
            exit;
        }
    }
}
