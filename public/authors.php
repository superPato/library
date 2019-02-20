<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/controllers/AuthorController.php';

	$authorController = new AuthorController(new DatabaseTable($pdo, 'authors'));

	if (isset($_GET['edit'])) {
		$page = $authorController->edit();
	}
	else if (isset($_GET['delete']))
	{
		$page = $authorController->delete();
	}
	else
	{
		$page = $authorController->home();
	}

	$title  = $page['title'];
	$output = $page['output'];
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf("Unable to connect to database server: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
