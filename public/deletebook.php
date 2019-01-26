<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	
	delete($pdo, 'books', $_POST['id']);

	header('location: books.php');
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf('Error in database server: %s %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
