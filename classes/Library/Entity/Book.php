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
    private $author;
    private $publisher;

    public function __construct(DatabaseTable $publishersTable, DatabaseTable $authorsTable)
    {
        $this->publishersTable = $publishersTable;
        $this->authorsTable = $authorsTable;
    }

    public function getPublisher()
    {
        if (empty($this->publisher)) {
            $this->publisher = $this->publishersTable->findById($this->publisherid);
        }

        return $this->publisher;
    }

    public function getAuthor()
    {
        if (empty($this->author)) {
            $this->author = $this->authorsTable->findById($this->authorid);
        }

        return $this->author;
    }
}