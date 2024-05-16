<?php

require_once('DBManager.php');
require_once('User.php');

class UserManager
{
    private $db;

    public function __construct()

    {
        $this->db = DBManager::getInstance()->getPDO();
    }

    public function saveUser(string $pseudo, string $email, string $password): bool
    {
        $sqlQuey = "INSERT INTO user (pseudo, email, password) VALUES (?, ?, ?)";
        $queryStatement = $this->db->prepare($sqlQuey);
        $success = $queryStatement->execute([$pseudo, $email, $password]);

        return $success;
    }

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
}
