<?php

include_once '../Models/Book.php';

class SearchController
{
    protected $data;
    
    public function __construct()
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->data = json_decode(file_get_contents('php://input'), true);
    }
    
    public function search(): void
    {
        $filter = $this->data['author_name'] ?? null;

        if ($filter) {
            $books = Book::searchBooksByAuthor($filter);
        } else {
            $books = [];
        }
        
        echo json_encode($books);
    }
}