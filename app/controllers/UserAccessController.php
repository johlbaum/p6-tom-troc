<?php

require_once '../app/views/View.php';
require_once '../app/models/UserManager.php';

/**
 * Contrôleur qui gère les accès à l'espace administrateur.
 */
class UserAccessController
{

    /**
     * Affiche le formulaire d'enregistrement et de connexion.
     * @param string $action : l'action à effectuer (signIn ou logIn).
     * @return void
     */
    public function displayUserAccessForm(string $action): void
    {
        $view = new View("Connexion");
        $view->render("userAccessForm", [
            'action' => $action
        ]);
    }


    /**
     * Enregistrement de l'utilisateur.
     * @return void
     */
    public function signInUser(): void
    {
        // On vérifie que les champs ne soient pas vides.
        if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: index.php?action=signInForm");
            exit();
            // On vérifie le format de l'adresse email.
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Le format de l'email n'est pas valide.";
            header("Location: index.php?action=signInForm");
            exit();
        } else {
            // On convertit les caractères spéciaux.
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // On crypte le mot de passe
            $cryptPassword = password_hash($password, PASSWORD_DEFAULT);

            // On vérifie que l'utilisateur n'existe pas déjà.
            $userManager = new UserManager();
            $user = $userManager->getUserByEmail($email);

            if ($user) {
                $_SESSION['message'] = "Un compte avec cette adresse e-mail existe déjà.";
                header("Location: index.php?action=signInForm");
                exit();
            } else {
                // On enregistre l'utilisateur dans la base de données.
                $userManager = new UserManager();
                $success = $userManager->saveUser($pseudo, $email, $cryptPassword);

                // On envoie un message de confirmation de création de compte ou d'erreur à l'utilisateur.
                if ($success) {
                    $_SESSION['message'] = "Votre compte a été créé avec succès. Vous pouvez désormais vous connecter à votre espace.";
                    header("Location: index.php?action=logInForm");
                    exit();
                } else {
                    $_SESSION['message'] = "Une erreur s'est produite lors de la création de votre compte.";
                    header("Location: index.php?action=signInForm");
                    exit();
                }
            }
        }
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function logInUser(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // On vérifie que les champs ne soient pas vides.
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: index.php?action=signInForm");
            exit();
            //On vérifie le format de l'adresse email.
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: index.php?action=signInForm");
            exit();
        } else {
            // On convertit les caractères spéciaux.
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // On vérifie que l'utilisateur existe.
            $userManager = new UserManager();
            $user = $userManager->getUserByEmail($email);

            // Si l'utilisateur existe :
            if ($user) {
                // On vérifie que le mot de passe est correct.
                if (!password_verify($password, $user->getPassword())) {
                    $_SESSION['message'] = "Le mot de passe est incorrect.";
                } else {
                    // On connecte l'utilisateur.
                    $_SESSION['userId'] = $user->getId();
                    $_SESSION['userEmail'] = $user->getEmail();

                    // On redirige l'utilisateur vers son espace.
                    header("Location: index.php?action=userDashboard");
                }
                // Si l'utilisateur n'existe pas :
            } else {
                $_SESSION['message'] = "L'utilisateur demandé n'existe pas.";
                header("Location: index.php?action=logInForm");
                exit();
            }
        }
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser(): void
    {
        unset($_SESSION['userEmail']);
        unset($_SESSION['userId']);

        header("Location: index.php?action=home");
    }
}
