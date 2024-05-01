<?php

require_once '../app/views/View.php';

class UserAccessController
{
    public function displayUserAccessForm($action): void
    {
        $view = new View("Connexion");
        $view->render("userAccessForm", [
            'action' => $action
        ]);
    }
}
