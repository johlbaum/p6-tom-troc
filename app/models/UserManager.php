<?php

require_once('AbstractEntityManager.php');
require_once('User.php');

/**
 * Classe qui gère les utilisateurs.
 */
class UserManager extends AbstractEntityManager
{
    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * @param string $pseudo : le pseudo de l'utilisateur.
     * @param string $email : l'adresse email de l'utilisateur.
     * @param string $password : le mot de passe de l'utilisateur.
     * @return bool : true si l'utilisateur a été enregistré avec succès, sinon false.
     */
    public function saveUser(string $pseudo, string $email, string $password): bool
    {
        try {
            $sql = "INSERT INTO user (pseudo, email, password) VALUES (?, ?, ?)";
            $statement = $this->pdo->prepare($sql);
            $success = $statement->execute([$pseudo, $email, $password]);

            return $success;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère un utilisateur à partir de son adresse email.
     * @param string $email : l'adresse email de l'utilisateur.
     * @return User|null : l'utilisateur correspondant à l'adresse email, ou null si aucun utilisateur trouvé.
     */
    public function getUserByEmail(string $email): ?User
    {
        try {
            $sql = "SELECT * FROM user WHERE email = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$email]);

            $userData = $statement->fetch();
            if ($userData) {
                return User::fromArray($userData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère un utilisateur à partir de son id.
     * @param int $userId : l'id de l'utilisateur.
     * @return User|null : l'utilisateur correspondant à l'id, ou null si aucun utilisateur trouvé.
     */
    public function getUserById(int $userId): ?User
    {
        try {
            $sql = "SELECT * FROM user WHERE id = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$userId]);

            $userData = $statement->fetch();
            if ($userData) {
                return User::fromArray($userData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Met à jour le profil d'un utilisateur dans la base de données.
     * @param int $userId : l'id de l'utilisateur.
     * @param string $pseudo : le nouveau pseudo de l'utilisateur.
     * @param string $email : le nouvel email de l'utilisateur.
     * @param string $password : le nouveau mot de passe de l'utilisateur.
     * @return bool : true si la mise à jour a réussi, sinon false.
     */
    public function updateUserProfile(int $userId, string $pseudo, string $email, string $password): bool
    {
        try {
            $sql = "UPDATE user SET email = :email, password = :password, pseudo = :pseudo WHERE id = :userId";
            $statement = $this->pdo->prepare($sql);
            $success = $statement->execute([
                'userId' => $userId,
                'email' => $email,
                'password' => $password,
                'pseudo' => $pseudo
            ]);

            return $success;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Met à jour l'image de profil d'un utilisateur dans la base de données.
     * @param int $userId : l'id de l'utilisateur.
     * @param string $imagePath : le chemin de l'image de profil.
     * @return void
     */
    public function updateUserProfileImage(int $userId, string $imagePath): void
    {
        try {
            $sql = "UPDATE user SET profile_image = :imagePath WHERE id = :userId";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'imagePath' => $imagePath,
                'userId' => $userId
            ]);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}
