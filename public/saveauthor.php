<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$authorTable = new DatabaseTable($pdo, 'authors');

	if (isset($_POST['author'])) {
		$authorTable->save($_POST['author']);

		header('location: authors.php');
	} else {
		$title = 'Add a new author';

		if (isset($_GET['id'])) {
			$title = 'Update author';
			$author = $authorTable->findById($_GET['id']);
		}

		ob_start();

		include __DIR__ . '/../templates/saveauthor.html.php';

		$output = ob_get_clean();
	}
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf("Database error: %s in %s:%s",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}


include __DIR__ . '/../templates/layout.html.php';
