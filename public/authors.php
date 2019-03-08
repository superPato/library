<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/controllers/AuthorController.php';

	$authorController = new AuthorController(new DatabaseTable($pdo, 'authors'));

	$action = $_GET['action'] ?? 'home';

	$page = $authorController->$action();

	$title  = $page['title'];
	
	if (isset($page['variables'])) {
		extract($page['variables']);
	}

	ob_start();

	include __DIR__ . "/../templates/{$page['template']}";

	$output = ob_get_clean();
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf("Unable to connect to database server: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
