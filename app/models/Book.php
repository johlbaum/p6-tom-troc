<?php

/**
 * Classe qui représente un livre.
 */
class Book
{
    private ?int $id;
    private ?int $userId;
    private ?string $userPseudo;
    private ?string $title;
    private ?string $author;
    private ?string $description;
    private ?string $availability;

    /**
     * Constructeur de la classe Book.
     * @param int|null $id : l'ID du livre.
     * @param int|null $userId : l'ID de l'utilisateur qui possède le livre.
     * @param int|null $user_pseudo : le pseudo de l'utilisateur qui possède le livre.
     * @param string|null $title : le titre du livre.
     * @param string|null $author : l'auteur du livre.
     * @param string|null $description : la description du livre.
     * @param string|null $availability : la disponibilité du livre.
     */
    public function __construct(int $id = null, int $userId = null, string $title = null, string $author = null, string $description = null, string $availability = null, string $user_pseudo = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->userPseudo = $user_pseudo;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->availability = $availability;
    }

    /**
     * Méthode statique qui crée et retourne un objet Book à partir des données fournies dans un tableau associatif.
     * Les clés du tableau associatif $array doivent correspondre aux noms des propriétés de l'objet Book.
     * @param array $array : tableau associatif contenant les données du livre.
     * @return Book : objet Book.
     */
    public static function fromArray(array $array): Book
    {
        $book = new Book();
        $book->setId($array['id'] ?? null);
        $book->setUserId($array['user_id'] ?? null);
        $book->setUserPseudo($array['user_pseudo'] ?? null);
        $book->setTitle($array['title'] ?? null);
        $book->setAuthor($array['author'] ?? null);
        $book->setDescription($array['description'] ?? null);
        $book->setAvailability($array['availability'] ?? null);

        return $book;
    }

    /**
     * Setter pour l'ID du livre.
     * @param int|null $id : l'ID du livre.
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'ID du livre.
     * @return int|null : l'ID du livre.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter pour l'ID de l'utilisateur qui possède le livre.
     * @param int|null $userId : l'ID de l'utilisateur.
     * @return void
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * Getter pour l'ID de l'utilisateur qui possède le livre.
     * @return int|null : l'ID de l'utilisateur.
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * Setter pour le pseudo de l'utilisateur qui possède le livre.
     * @param string|null $userPseudo : le pseudo de l'utilisateur.
     * @return void
     */
    public function setUserPseudo(?string $userPseudo): void
    {
        $this->userPseudo = $userPseudo;
    }

    /**
     * Getter pour le pseudo de l'utilisateur qui possède le livre.
     * @return string|null : le pseudo de l'utilisateur.
     */
    public function getUserPseudo(): ?string
    {
        return $this->userPseudo;
    }

    /**
     * Setter pour le titre du livre.
     * @param string|null $title : le titre du livre.
     * @return void
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre du livre.
     * @return string|null : le titre du livre.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter pour l'auteur du livre.
     * @param string|null $author : l'auteur du livre.
     * @return void
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter pour l'auteur du livre.
     * @return string|null : l'auteur du livre.
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Setter pour la description du livre.
     * @param string|null $description : la description du livre.
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter pour la description du livre.
     * @return string|null : la description du livre
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter pour la disponibilité du livre.
     * @param string|null $availability : la disponibilité du livre.
     * @return void
     */
    public function setAvailability(?string $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * Getter pour la disponibilité du livre.
     * @return string|null : la disponibilité du livre.
     */
    public function getAvailability(): ?string
    {
        return $this->availability;
    }
}
