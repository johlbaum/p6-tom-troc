<?php

require_once('DBManager.php');
require_once('Book.php');

/**
 * Classe qui gère les livres.
 */
class BookManager
{
    /**
     * Instance de la classe DBManager.
     */
    private $db;

    /**
     * Constructeur de la classe BookManager.
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->db = DBManager::getInstance()->getPDO();
    }

    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks(): array
    {
        $sql = "
            SELECT book.*, user.pseudo AS user_pseudo 
            FROM book
            JOIN user ON book.user_id = user.id
            ORDER BY book.id DESC
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $books = [];

        while ($bookData = $statement->fetch()) {
            $books[] = Book::fromArray($bookData);
        }

        return $books;
    }

    /**
     * Récupère tous les livres d'un utilisateur.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooksByUser(int $userId): array
    {
        try {
            $sql = "
                SELECT 
                    book.*, 
                    user.pseudo AS user_pseudo 
                FROM 
                    book 
                JOIN 
                    user 
                ON 
                    book.user_id = user.id
                WHERE 
                    book.user_id = :userId
            ";
            $statement = $this->db->prepare($sql);
            $statement->execute(['userId' => $userId]);

            $allBooksByUser = [];

            while ($allBooksByUserData = $statement->fetch()) {
                $allBooksByUser[] = Book::fromArray($allBooksByUserData);
            }

            return $allBooksByUser;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Récupère les 4 derniers livres ajoutés.
     * @return array : un tableau d'objets Book.
     */
    public function lastBooksAdded(): array
    {
        $sql = "
            SELECT book.*, user.pseudo AS user_pseudo 
            FROM book
            JOIN user ON book.user_id = user.id
            ORDER BY book.id DESC
            LIMIT 4
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $lastBooksAdded = [];

        while ($lastBookAddedData = $statement->fetch()) {
            $lastBooksAdded[] = Book::fromArray($lastBookAddedData);
        }
        return $lastBooksAdded;
    }

    /**
     * Récupère un livre par son id.
     * @param int $id : l'id du livre.
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(int $bookId): ?Book
    {
        $sql = "
            SELECT book.*, user.pseudo AS user_pseudo 
            FROM book
            JOIN user ON book.user_id = user.id
            WHERE book.id = ? 
        ";

        $statement = $this->db->prepare($sql);
        $statement->execute([$bookId]);

        $bookData = $statement->fetch();

        if ($bookData) {
            return Book::fromArray($bookData);
        }

        return null;
    }

    /**
     * Ajoute ou modifie un livre.
     * Si l'id est null, il s'agit d'une création de livre. 
     * @param Book $book : le livre à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateBook(Book $book): void
    {
        if ($book->getId() === null) {
            $this->addBook($book);
        } else {
            $this->updateBook($book);
        }
    }

    /**
     * Ajoute un livre.
     * @param Book $book : le livre à ajouter.
     * @return void
     */
    public function addBook(Book $book): void
    {
        try {
            $sql = "INSERT INTO book (user_id, title, author, description, availability) VALUES (:user_id, :title, :author, :description, :availability)";
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'user_id' => $book->getUserId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
                'availability' => $book->getAvailability()
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Modifie un livre.
     * @param Book $book : le livre à modifier.
     * @return void
     */
    public function updateBook(Book $book): void
    {
        try {
            $sql = "UPDATE book SET title = :title, author = :author, description = :description, availability = :availability WHERE id = :id";
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
                'availability' => $book->getAvailability()
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Supprime un livre.
     * @param int $id : l'id du livre à supprimer.
     * @return void
     */
    public function deleteBook(int $bookId): void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $bookId]);
    }

    /**
     * Recherche les livres par titre.
     * @param string $searchValue : la valeur de recherche.
     * @return array : un tableau d'objets Book.
     */
    public function searchBooks(string $searchValue): array
    {
        try {
            $sql = "
            SELECT book.*, user.pseudo AS user_pseudo 
            FROM book
            JOIN user ON book.user_id = user.id
            WHERE book.title LIKE :searchValue
        ";
            $statement = $this->db->prepare($sql);
            // Ajout du caractère joker à la fin de la la valeur de recherche pour permettre de rechercher 
            // les livres dont les titres commencent exactement par la valeur de recherche fournie par l'utilisateur.
            $statement->execute(['searchValue' => $searchValue . '%']);

            $searchResults = [];

            while ($bookData = $statement->fetch()) {
                $searchResults[] = Book::fromArray($bookData);
            }

            return $searchResults;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
