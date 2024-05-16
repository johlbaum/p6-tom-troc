<?php

class DBManager
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public static function getInstance(): DBManager
    {
        if (self::$instance == null) {
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
