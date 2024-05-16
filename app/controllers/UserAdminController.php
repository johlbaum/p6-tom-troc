<?php

require_once '../app/views/View.php';

class UserAdminController
{
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

    private function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['userEmail'])) {
            header("Location: index.php?action=logInForm");
        }
    }
}
