<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$bookTable = new DatabaseTable($pdo, 'books');
	$publisherTable = new DatabaseTable($pdo, 'publisher');

	if (isset($_POST['book'])) {
		$book = $_POST['book'];
		$bookTable->save($book);

		header('location: books.php');
	} else {
		$title = 'Add book';

		if (isset($_GET['id'])) {
			$title = 'Update book';
			$book = $bookTable->findById($_GET['id']);
		}

		$publishers = $publisherTable->findAll();
	
		ob_start();

		include __DIR__ . '/../templates/savebook.html.php';

		$output = ob_get_clean();
	}
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf(
		'Error in database: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
