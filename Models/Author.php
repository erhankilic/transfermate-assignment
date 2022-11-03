<?php

include_once '../Classes/DB.php';

class Author extends DB
{
    public static function searchAuthorsByName(string $name): array
    {
        if(!self::$pdo) {
            self::connect();
        }

        $sql = "SELECT * FROM authors WHERE full_name LIKE ? ORDER BY full_name";

        $q = self::$pdo->prepare($sql);
        $q->execute(["%$name%"]);

        return $q->fetchAll();
    }

    public static function getAuthorByName(string $name)
    {
        if(!self::$pdo) {
            self::connect();
        }

        $sql = "SELECT * FROM authors WHERE full_name = ? LIMIT 1";

        $q = self::$pdo->prepare($sql);
        $q->execute([$name]);

        return $q->fetch();
    }

    public static function addAuthor(string $name): array|bool
    {
        if(!self::$pdo) {
            self::connect();
        }

        $sql = "INSERT INTO authors (full_name) VALUES (?)";
        $q = self::$pdo->prepare($sql);
        $status = $q->execute([$name]);

        if ($status) {
            return self::getAuthorByName($name);
        }

        return $status;
    }
}