<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
	if (isset($_POST['title'])) {
		save($pdo, 'books', [
			'id' => $_POST['bookid'], 
			'title' => $_POST['title'], 
			'publishingdate' => $_POST['publishingdate'], 
			'publisherid' => $_POST['publisherid']
		]);

		header('location: books.php');
	} else {
		$book = findById($pdo, 'books', $_GET['id']);

		$publishers = $pdo->query('SELECT `id`, `name` FROM `publisher`');

		$title = 'Update book: ' . $book['title'];

		ob_start();

		include __DIR__ . '/../templates/editbook.html.php';

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
