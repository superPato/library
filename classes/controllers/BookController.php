<?php

class BookController {
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
        $title = 'Internet Library Database';

        ob_start();

        include __DIR__ . '/../../templates/home.html.php';

        $output = ob_get_clean();

        return compact('title', 'output');
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

        $title = 'List Books';

        $totalBooks = $this->booksTable->total();

        ob_start();

        include __DIR__ . '/../../templates/books.html.php';

        $output = ob_get_clean();

        return compact('title', 'output');
    }

    public function edit()
    {
        if (isset($_POST['book'])) {
            $book = $_POST['book'];
            $this->booksTable->save($book);

            header('location: index.php?action=list');
        } else {
            $title = 'Add book';

            if (isset($_GET['id'])) {
                $title = 'Update book';
                $book = $this->booksTable->findById($_GET['id']);
            }

            $publishers = $this->publishersTable->findAll();

            ob_start();

            include __DIR__ . '/../../templates/savebook.html.php';

            $output = ob_get_clean();
        }

        return compact('title', 'output');
    }

    public function delete()
    {
        $this->booksTable->delete($_POST['id']);

	    header('location: index.php?action=list');
    }
}
