<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
	if (isset($_POST['title'])) {
		editBook($pdo, $_POST['bookid'], $_POST['title'], $_POST['publishingdate'], $_POST['publisherid']);

		header('location: books.php');
	} else {
		$book = getBook($pdo, $_GET['id']);

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
