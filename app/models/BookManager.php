<?php

require_once('AbstractEntityManager.php');
require_once('Book.php');

/**
 * Classe qui gère les livres.
 */
class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks(): array
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
                ORDER BY 
                    book.title ASC
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $books = [];

            while ($bookData = $statement->fetch()) {
                $books[] = Book::fromArray($bookData);
            }

            return $books;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
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
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['userId' => $userId]);

            $allBooksByUser = [];

            while ($allBooksByUserData = $statement->fetch()) {
                $allBooksByUser[] = Book::fromArray($allBooksByUserData);
            }

            return $allBooksByUser;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère les 4 derniers livres ajoutés.
     * @return array : un tableau d'objets Book.
     */
    public function lastBooksAdded(): array
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
                ORDER BY 
                    book.id DESC
                LIMIT 4
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $lastBooksAdded = [];

            while ($lastBookAddedData = $statement->fetch()) {
                $lastBooksAdded[] = Book::fromArray($lastBookAddedData);
            }
            return $lastBooksAdded;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Récupère un livre par son id.
     * @param int $id : l'id du livre.
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(int $bookId): ?Book
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
                    book.id = ? 
            ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$bookId]);

            $bookData = $statement->fetch();

            if ($bookData) {
                return Book::fromArray($bookData);
            }

            return null;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
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
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'user_id' => $book->getUserId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
                'availability' => $book->getAvailability()
            ]);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
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
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
                'availability' => $book->getAvailability()
            ]);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    /**
     * Supprime un livre.
     * @param int $id : l'id du livre à supprimer.
     * @return void
     */
    public function deleteBook(int $bookId): void
    {
        try {
            $sql = "DELETE FROM book WHERE id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['id' => $bookId]);
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
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
                SELECT 
                    book.*, user.pseudo AS user_pseudo 
                FROM 
                    book
                JOIN 
                    user 
                ON 
                    book.user_id = user.id
                WHERE 
                    book.title 
                LIKE 
                    :searchValue
            ";
            $statement = $this->pdo->prepare($sql);
            // Ajout du caractère joker à la fin de la la valeur de recherche pour permettre de rechercher 
            // les livres dont les titres commencent exactement par la valeur de recherche fournie par l'utilisateur.
            $statement->execute(['searchValue' => $searchValue . '%']);

            $searchResults = [];

            while ($bookData = $statement->fetch()) {
                $searchResults[] = Book::fromArray($bookData);
            }

            return $searchResults;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}
