<?php

require_once('DBManager.php');
require_once('User.php');

/**
 * Classe qui gère les utilisateurs.
 */
class UserManager
{
    /**
     * Instance de la classe DBManager.
     */
    private $db;

    /**
     * Constructeur de la classe UserManager.
     * Initialise la connexion à la base de données.
     */
    public function __construct()

    {
        $this->db = DBManager::getInstance()->getPDO();
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * @param string $pseudo : le pseudo de l'utilisateur.
     * @param string $email : l'adresse email de l'utilisateur.
     * @param string $password : le mot de passe de l'utilisateur.
     * @return bool : true si l'utilisateur a été enregistré avec succès, sinon false.
     */
    public function saveUser(string $pseudo, string $email, string $password): bool
    {
        $sqlQuey = "INSERT INTO user (pseudo, email, password) VALUES (?, ?, ?)";
        $queryStatement = $this->db->prepare($sqlQuey);
        $success = $queryStatement->execute([$pseudo, $email, $password]);

        return $success;
    }

    /**
     * Récupère un utilisateur à partir de son adresse email.
     * @param string $email : l'adresse email de l'utilisateur.
     * @return User|null : l'utilisateur correspondant à l'adresse email, ou null si aucun utilisateur trouvé.
     */
    public function getUserByEmail(string $email): ?User
    {
        $sqlQuey = "SELECT * FROM user WHERE email = ?";
        $queryStatement = $this->db->prepare($sqlQuey);
        $queryStatement->execute([$email]);
        $user = $queryStatement->fetch();

        if ($user) {
            return User::fromArray($user);
        } else {
            return null;
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
        $sqlQuey = "UPDATE user SET email = :email, password = :password, pseudo = :pseudo WHERE id = :userId";
        $queryStatement = $this->db->prepare($sqlQuey);
        $success = $queryStatement->execute([
            'userId' => $userId,
            'email' => $email,
            'password' => $password,
            'pseudo' => $pseudo
        ]);

        return $success;
    }

    /**
     * Met à jour l'image de profil d'un utilisateur dans la base de données.
     * @param int $userId : l'id de l'utilisateur.
     * @param string $imagePath : le chemin de l'image de profil.
     * @return void
     */
    public function updateUserProfileImage(int $userId, string $imagePath): void
    {
        $sqlQuey = "UPDATE user SET profile_image = :imagePath WHERE id = :userId";
        $queryStatement = $this->db->prepare($sqlQuey);
        $queryStatement->execute([
            'imagePath' => $imagePath,
            'userId' => $userId
        ]);
    }
}
