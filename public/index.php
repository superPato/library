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

    $booksTable = new DatabaseTable($pdo, 'books');
    $publishersTable = new DatabaseTable($pdo, 'publisher');
    $authorsTable = new DatabaseTable($pdo, 'authors');

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    if ($route == strtolower($route)) 
    {
        if ($route == 'books/list') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->list();
        } 
        elseif ($route == 'books/edit') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->edit();
        }
        elseif ($route == 'books/delete') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->delete();
        }
        elseif ($route == 'books/home') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->home();
        }
        elseif ($route == 'authors/home') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->home();
        }
        elseif ($route == 'authors/edit') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->edit();
        }
        elseif ($route == 'authors/delete') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->delete();
        }
    } 
    else
    {
        http_response_code(301);
        header('location: index.php?route=' . strtolower($action));
    }

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
