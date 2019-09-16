<?php


namespace Library\Entity;


use Framework\DatabaseTable;

class Tag
{
    public $id;
    public $name;
    private $booksTable;
    private $bookTagTable;


    public function __construct(DatabaseTable $booksTable, DatabaseTable $bookTagTable)
    {
        $this->booksTable = $booksTable;
        $this->bookTagTable = $bookTagTable;
    }

    public function getBooks()
    {
        $books = [];

        $bookTags = $this->bookTagTable->find('tag_id', $this->id);

        foreach ($bookTags as $bookTag) {
            $book = $this->booksTable->findById($bookTag->book_id);

            if ($book) {
                array_push($books, $book);
            }
        }

        return $books;
    }
}