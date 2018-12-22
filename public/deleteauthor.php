<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';

	$sql = 'DELETE FROM `authors` WHERE `id` = :id';

	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':id', $_POST['id']);
	$stmt->execute();

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
