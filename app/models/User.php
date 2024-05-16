<?php

class User
{
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;

    public function __construct(int $id = null, string $pseudo = null, string $email = null, string $password = null)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromArray(array $array): User
    {
        $user = new User();
        $user->setId($array['id']);
        $user->setPseudo($array['pseudo']);
        $user->setEmail($array['email']);
        $user->setPassword($array['password']);
        return $user;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
