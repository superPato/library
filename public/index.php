<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../classes/controllers/BookController.php';

    $booksTable = new DatabaseTable($pdo, 'books');
    $publishersTable = new DatabaseTable($pdo, 'publisher');

    $bookController = new BookController($booksTable, $publishersTable);

    if (isset($_GET['edit'])) 
    {
        $page = $bookController->edit();
    }
    else if (isset($_GET['delete']))
    {
        $page = $bookController->delete();
    }
    else if (isset($_GET['list']))
    {
        $page = $bookController->list();
    }
    else 
    {
        $page = $bookController->home();
    }

    $title  = $page['title'];
    $output = $page['output'];
} catch (PDOException $e) {
    $title = 'An error has ocurred.';

	$output = sprintf('Error to connect to database server: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';