<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$books = allBooks($pdo);

	$title = 'List Books';

	$totalBooks = totalBooks($pdo);

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
