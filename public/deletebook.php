<?php 

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'DELETE FROM `books` WHERE id = :id';

	$stmt = $pdo->prepare($sql);

	$stmt->bindValue(':id', $_POST['id']);
	$stmt->execute();

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