<?php

function loadTemplate($templateFileName, $variables = [])
{
    extract($variables);

    ob_start();

    require __DIR__ . "/../templates/{$templateFileName}";

    return ob_get_clean();
}

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../classes/controllers/BookController.php';

    $booksTable = new DatabaseTable($pdo, 'books');
    $publishersTable = new DatabaseTable($pdo, 'publisher');

    $bookController = new BookController($booksTable, $publishersTable);

    $action = $_GET['action'] ?? 'home';

    $page = $bookController->$action();

    $title = $page['title'];

    if (isset($page['variables'])) {
        $output = loadTemplate($page['template'], $page['variables']);
    } else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = 'An error has ocurred.';

	$output = sprintf('Error to connect to database server: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/layout.html.php';
