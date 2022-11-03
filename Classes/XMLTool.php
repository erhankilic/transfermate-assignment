<?php

include_once '../Models/Book.php';

class XMLTool
{
    public static function scanFolder(string $path): void
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file) {
            $filePath = $path . $file;
            if (is_dir($filePath)) {
                self::scanFolder("$filePath/");
            } else {
                self::readXML($filePath);
            }
        }
    }

    public static function readXML(string $file): void
    {
        $dom = new DOMDocument();
        $dom->load($file);
        $books = $dom->getElementsByTagName('book');

        foreach ($books as $book) {
            $author = null;
            $name = null;

            foreach ($book->childNodes as $childNode) {
                if ($childNode->nodeName == 'author') {
                    $author = $childNode->nodeValue;
                }

                if ($childNode->nodeName == 'name') {
                    $name = $childNode->nodeValue;
                }
            }

            Book::addBook($author, $name);
        }
    }
}