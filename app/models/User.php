<?php

/**
 * Classe qui représente un utilisateur.
 */
class User
{
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;

    /**
     * Constructeur de la classe User.
     * @param int|null $id : l'ID de l'utilisateur.
     * @param string|null $pseudo : le pseudo de l'utilisateur.
     * @param string|null $email : l'email de l'utilisateur.
     * @param string|null $password : le mot de passe de l'utilisateur.
     */
    public function __construct(int $id = null, string $pseudo = null, string $email = null, string $password = null)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Méthode qui crée et retourne un objet User à partir des données fournies dans un tableau associatif.
     * Les clés du tableau associatif $array doivent correspondre aux noms des propriétés de l'objet User.
     * @param array $array : tableau associatif contenant les données de l'utilisateur.
     * @return User : objet User.
     */
    public static function fromArray(array $array): User
    {
        $user = new User();
        $user->setId($array['id']);
        $user->setPseudo($array['pseudo']);
        $user->setEmail($array['email']);
        $user->setPassword($array['password']);

        return $user;
    }

    /**
     * Setter pour l'id de utilisateur.
     * @param int $id : l'id de l'utilisateur. 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour le pseudo de utilisateur.
     * @param int $pseudo : le pseudo de l'utilisateur. 
     * @return void
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo de l'utilisateur.
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le l'email de utilisateur.
     * @param string $email : l'email de l'utilisateur. 
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter pour le l'email de l'utilisateur.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setter pour le password de utilisateur.
     * @param string $password : le password de l'utilisateur. 
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password de l'utilisateur.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
