<?php

include_once '../Classes/DB.php';
include_once 'Author.php';

class Book extends DB
{
    public static function addBook(string $authorName, string $name): array|bool
    {
        $book = self::getBookByName($name);
        $author = Author::getAuthorByName($authorName);

        if (!$author) {
            $author = Author::addAuthor($authorName);
        }
        
        if ($book && $book['author_id'] == $author['id']) {
            return $book;
        }

        $sql = "INSERT INTO books (author_id, book_name) VALUES (?,?)";
        $q = self::$pdo->prepare($sql);
        $status = $q->execute([$author['id'], $name]);

        if ($status) {
            return self::getBookByName($name);
        }

        return $status;
    }

    public static function searchBooksByName(string $name): array
    {
        if(!self::$pdo) {
            self::connect();
        }

        $sql = "SELECT * FROM books WHERE book_name LIKE ? ORDER BY book_name";

        $q = self::$pdo->prepare($sql);
        $q->execute(["%$name%"]);

        return $q->fetchAll();
    }

    public static function getBookByName(string $name)
    {
        if(!self::$pdo) {
            self::connect();
        }

        $sql = "SELECT * FROM books WHERE book_name = ? LIMIT 1";

        $q = self::$pdo->prepare($sql);
        $q->execute([$name]);

        return $q->fetch();
    }
}