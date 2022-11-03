<?php

class DB
{
    protected static $pdo;
    protected const DB_SERVER = 'localhost';
    protected const DB_PORT = '5432';
    protected const DB_NAME = 'erhan';
    protected const DB_USER = 'erhan';
    protected const DB_PASSWORD = '123456';
    
    public static function connect(): void
    {
        $settings = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $query = sprintf(
            "pgsql:host=%s port=%s dbname=%s user=%s password=%s",
            self::DB_SERVER,
            self::DB_PORT,
            self::DB_NAME,
            self::DB_USER,
            self::DB_PASSWORD
        );

        try {
            self::$pdo = new PDO($query, null, null, $settings);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function setupDB(): void
    {
        if (!self::$pdo) {
            self::connect();
        }

        $query = 'CREATE TABLE authors (
            id INT GENERATED ALWAYS AS IDENTITY,
            full_name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        );';

        try {
            self::$pdo->exec($query);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $query = 'CREATE TABLE books (
            id INT GENERATED ALWAYS AS IDENTITY,
            author_id INT NOT NULL,
            book_name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id),
            CONSTRAINT fk_author
                FOREIGN KEY(author_id) 
	            REFERENCES authors(id)
        );';

        try {
            self::$pdo->exec($query);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
