<?php

namespace Library\Controllers;

use Framework\Authentication;
use Framework\DatabaseTable;

class Book {
    private $booksTable;
    private $publishersTable;
    private $authentication;
    private $authorsTable;
    private $tagsTable;

    public function __construct(DatabaseTable $booksTable,
                                DatabaseTable $authorsTable,
                                DatabaseTable $publishersTable,
                                DatabaseTable $tagsTable,
                                Authentication $authentication)
    {
        $this->booksTable = $booksTable;
        $this->authorsTable = $authorsTable;
        $this->publishersTable = $publishersTable;
        $this->tagsTable = $tagsTable;
        $this->authentication = $authentication;
    }

    public function home()
    {
        return [
            'title'    => 'Internet Library Database', 
            'template' => 'home.html.php'
        ];
    }

    public function list()
    {
        if (isset($_GET['tag'])) {
            $tag = $this->tagsTable->findById($_GET['tag']);

            $books = $tag->getBooks();
        } else {
            $books = $this->booksTable->findAll();
        }

        $tags = $this->tagsTable->findAll();

        $totalBooks = $this->booksTable->total();

        $isLoggedIn = $this->authentication->isLoggedIn();

        return [
            'title'     => 'List Books',
            'template'  => 'books.html.php',
            'variables' => compact('books', 'tags', 'totalBooks', 'isLoggedIn'),
        ];
    }

    public function saveEdit()
    {
        $book = $_POST['book'];

        $bookEntity = $this->booksTable->save($book);

        $bookEntity->clearTags();

        foreach ($_POST['tags'] as $tag) {
            $bookEntity->addTag($tag);
        }

        header('location: /books/list');
    }

    public function edit()
    {
        $title = 'Add book';

        $tags = $this->tagsTable->findAll();

        if (isset($_GET['id'])) {
            $title = 'Update book';
            $book = $this->booksTable->findById($_GET['id']);
        }

        $publishers = $this->publishersTable->findAll();
        $authors = $this->authorsTable->findAll();

        return [
            'title'     => $title,
            'template'  => 'savebook.html.php',
            'variables' => [
                'book'       => $book ?? null,
                'publishers' => $publishers,
                'authors'    => $authors,
                'tags'       => $tags,
            ]
        ];
    }

    public function delete()
    {
        $this->booksTable->delete($_POST['id']);

	    header('location: /books/list');
    }
}
