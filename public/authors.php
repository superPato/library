<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$authorTable = new DatabaseTable($pdo, 'authors');

	$authors = $authorTable->findAll();

	$title = 'Author list';

	ob_start();

	include __DIR__ . '/../templates/authors.html.php';

	$output = ob_get_clean();

} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf("Unable to connect to database server: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
