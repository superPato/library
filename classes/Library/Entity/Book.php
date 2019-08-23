<?php


namespace Library\Entity;


use Framework\DatabaseTable;

class Book
{
    public $id;
    public $publishingdate;
    public $title;
    public $publisherid;
    public $authorid;
    private $publishersTable;
    private $authorsTable;

    public function __construct(DatabaseTable $publishersTable, DatabaseTable $authorsTable)
    {
        $this->publishersTable = $publishersTable;
        $this->authorsTable = $authorsTable;
    }

    public function getPublisher()
    {
        return $this->publishersTable->findById($this->publisherid);
    }

    public function getAuthor()
    {
        return $this->authorsTable->findById($this->authorid);
    }
}