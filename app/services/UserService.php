<?php

require_once '../app/models/UserManager.php';

class UserService
{
    /**
     * Récupère l'ancienneté de l'inscription de l'utilisateur formatée en années, mois ou jours.
     * @param int $userId : l'identifiant de l'utilisateur.
     * @return string : la durée d'inscription de l'utilisateur.
     */
    public function getUserRegistrationDate(int $userId): string
    {
        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        $createdAt = $user->getCreatedAt();

        $now = new DateTime();
        // "diff " : méthode de l'objet DateTime qui calcule la différence entre deux dates et renvoie un objet de 
        // type DateInterval représentant cette différence.
        $interval = $createdAt->diff($now);

        if ($interval->y > 0) {
            $membershipDuration = $interval->y . ' année(s)';
        } elseif ($interval->m > 0) {
            $membershipDuration = $interval->m . ' mois';
        } else {
            $membershipDuration = $interval->d . ' jour(s)';
        }

        return $membershipDuration;
    }
}
