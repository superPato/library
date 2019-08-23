<?php


namespace Library\Entity;


use Framework\DatabaseTable;

class Author
{
    public $id;
    public $firstname;
    public $lastname;

    private $booksTable;

    public function __construct(DatabaseTable $booksTable)
    {
        $this->booksTable = $booksTable;
    }

    public function name()
    {
        return "{$this->lastname}, {$this->firstname}";
    }

    public function getBooks()
    {
        return $this->booksTable->find('authorid', $this->id);
    }
}