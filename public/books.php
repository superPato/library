<?php 

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT `id`, `title` FROM `books`';
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

