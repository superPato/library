<?php

function loadTemplate($templateFileName, $variables = [])
{
	extract($variables);

	ob_start();

	include __DIR__ . "/../templates/{$templateFileName}";

	return ob_get_clean();
}

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/controllers/AuthorController.php';

	$authorController = new AuthorController(new DatabaseTable($pdo, 'authors'));

	$action = $_GET['action'] ?? 'home';

	if ($action == strtolower($action)) {
		$page = $authorController->$action();
	} else {
		http_response_code(301);
		header('location: index.php?action=' . strtolower($action));
	}

	$title  = $page['title'];

	if (isset($page['variables'])) {
		$output = loadTemplate($page['template'], $page['variables']);
	} else {
		$output = loadTemplate($page['template']);
	}
} catch (PDOException $e) {
	$title = 'An error has ocurred';

	$output = sprintf("Unable to connect to database server: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
