<?php

require_once '../app/views/View.php';

/**
 * Contrôleur qui gère l'espace administrateur.
 */
class UserAdminController
{
    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showUserDashbord(): void
    {
        $this->checkIfUserIsConnected();

        $userEmail = $_SESSION['userEmail'];

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($userEmail);

        $view = new View('Espace administrateur');
        $view->render("userDashbord", [
            'user' => $user
        ]);
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['userEmail'])) {
            header("Location: index.php?action=logInForm");
        }
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
            $userManager = new UserManager();
            $success = $userManager->updateUserProfile($userId, $pseudo, $email, $cryptPassword);

            // On envoie un message de confirmation de mise à jour de compte ou d'erreur à l'utilisateur.
            if ($success) {
                $_SESSION['userEmail'] = $email;
                $_SESSION['message'] = "Votre compte a été mis à jour avec succès.";
            } else {
                $_SESSION['message'] = "Une erreur s'est produite lors de la mise à jour de votre compte.";
            }
        }

        header("Location: index.php?action=userDashbord");
    }

    /**
     * Ajoute ou met à jour l'image de profil de l'utilisateur.
     * @return void
     */
    public function updateUserProfileImage(): void
    {
        // Récupération de l'objet User pour lequel on souhaite ajouter ou modifier un image de profil.
        $userEmail = $_SESSION['userEmail'];
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($userEmail);

        //Récupération de l'id de l'utilisateur.
        $userId = $user->getId();

        // Suppression de l'ancienne image du disque si un utilisateur a déjà ajouté une image à son profil et qu'il souhaite la modifier.
        $userProfileImage = $user->getProfileImage();
        if (file_exists($userProfileImage)) {
            unlink($userProfileImage);
        }

        if (isset($_FILES['profile-image'])) {
            // Nom du fichier / Nom temporaire du fichier généré par PHP / Extension du fichier. 
            $file_name = $_FILES['profile-image']['name'];
            $file_tmp = $_FILES['profile-image']['tmp_name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Définit le nom du fichier de destination ("profile-img - id de l'utilisateur . extension du fichier") et le chemin vers lequel on souhaite déplacer le nouveau fichier téléchargé.
            $destination = sprintf('./img/profile-img-user-%d.%s', $user->getId(), $file_extension);

            // Déplace le nouveau fichier téléchargé vers le répertoire de destination.
            move_uploaded_file($file_tmp, $destination);

            // Met à jour le chemin de l'image dans l'objet User.
            $user->setProfileImage($destination);

            // Met à jour le chemin de l'image dans la base de données.
            $userManager->updateUserProfileImage($userId, $destination);
        }

        header("Location: index.php?action=userDashbord");
    }
}
