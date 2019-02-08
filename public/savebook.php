<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
	if (isset($_POST['book'])) {
		$book = $_POST['book'];
		save($pdo, 'books', $book);

		header('location: books.php');
	} else {
		$title = 'Add book';

		if (isset($_GET['id'])) {
			$title = 'Update book';
			$book = findById($pdo, 'books', $_GET['id']);
		}

		$publishers = findAll($pdo, 'publisher');

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
