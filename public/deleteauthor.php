<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	delete($pdo, 'authors', $_POST['id']);

	header('location: authors.php');
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf('Error in database server: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
