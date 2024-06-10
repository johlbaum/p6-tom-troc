<?php

/**
 * Classe abstraite qui récupère automatiquement le gestionnaire de base de données. 
 */
abstract class AbstractEntityManager
{

    protected $pdo;

    public function __construct()
    {
        $dbManager = DBManager::getInstance();
        $this->pdo = $dbManager->getPDO();
    }
}
