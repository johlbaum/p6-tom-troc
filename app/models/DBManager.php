<?php

/**
 * Classe qui permet de se connecter à la base de données et de récupérer l'objet PDO.
 */
class DBManager
{
    private static $instance = null;
    private $pdo;

    /**
     * Constructeur privé pour empêcher l'instanciation directe de la classe.
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    /**
     * Méthode statique pour obtenir une instance unique de DBManager.
     * Si aucune instance n'existe, elle en crée une et la retourne. Sinon, elle retourne l'instance existante.
     * @return DBManager : instance de DBManager.
     */
    public static function getInstance(): DBManager
    {
        if (self::$instance == null) {
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    /**
     * Getter pour obtenir l'objet PDO représentant la connexion à la base de données.
     * @return PDO : objet PDO.
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
