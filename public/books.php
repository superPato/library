<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$booksTable = new DatabaseTable($pdo, 'books');
	$publisherTable = new DatabaseTable($pdo, 'publisher');

	$result = $booksTable->findAll();

	$books = [];
	foreach ($result as $book) {
		$publisher = $publisherTable->findById($book['publisherid']);

		$books[] = [
			'id'    => $book['id'],
			'title' => $book['title'],
			'name'  => $publisher['name'],
		];
	}

	$title = 'List Books';

	$totalBooks = $booksTable->total();

	ob_start();

	include __DIR__ . '/../templates/books.html.php';

	$output = ob_get_clean();
} catch (PDOException $e) {
	$title = 'An error has ocurred.';

	$output = sprintf('Error to connect to database server: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
