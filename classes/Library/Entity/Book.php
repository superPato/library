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
    private $bookTagTable;
    private $author;
    private $publisher;

    public function __construct(DatabaseTable $publishersTable,
                                DatabaseTable $authorsTable,
                                DatabaseTable $bookTagTable)
    {
        $this->publishersTable = $publishersTable;
        $this->authorsTable = $authorsTable;
        $this->bookTagTable = $bookTagTable;
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

    public function addTag($tagId)
    {
        $this->bookTagTable->save(['book_id' => $this->id, 'tag_id' => $tagId]);
    }
}