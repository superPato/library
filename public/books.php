<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';

	$sql = 'SELECT `books`.`id`, `title`, `name`
			FROM `books` INNER JOIN `publisher`
				ON `publisherid` = `publisher`.`id`';

	$books = $pdo->query($sql);

	$title = 'List Books';

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
