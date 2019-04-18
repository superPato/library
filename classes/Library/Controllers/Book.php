<?php

namespace Library\Controllers;

use Framework\DatabaseTable;

class Book {
    private $booksTable;
    private $publishersTable;

    public function __construct(DatabaseTable $booksTable,
                                DatabaseTable $publishersTable)
    {
        $this->booksTable = $booksTable;
        $this->publishersTable = $publishersTable;
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
        $result = $this->booksTable->findAll();

        $books = [];
        foreach ($result as $book) {
            $publisher = $this->publishersTable->findById($book['publisherid']);

            $books[] = [
                'id'    => $book['id'],
                'title' => $book['title'],
                'name'  => $publisher['name'],
            ];
        }

        $totalBooks = $this->booksTable->total();

        return [
            'title'     => 'List Books',
            'template'  => 'books.html.php',
            'variables' => compact('books', 'totalBooks'),
        ];
    }

    public function edit()
    {
        if (isset($_POST['book'])) {
            $book = $_POST['book'];
            $this->booksTable->save($book);

            header('location: /books/list');
        } else {
            $title = 'Add book';

            if (isset($_GET['id'])) {
                $title = 'Update book';
                $book = $this->booksTable->findById($_GET['id']);
            }

            $publishers = $this->publishersTable->findAll();
        }

        return [
            'title'     => $title,
            'template'  => 'savebook.html.php',
            'variables' => [
                'book'       => $book ?? null,
                'publishers' => $publishers,
            ]
        ];
    }

    public function delete()
    {
        $this->booksTable->delete($_POST['id']);

	    header('location: /books/list');
    }
}
