<?php

class LibraryRoutes 
{
	public function callAction($route)
	{
		include __DIR__ . '/../includes/DatabaseConnection.php';

	    $booksTable = new DatabaseTable($pdo, 'books');
	    $publishersTable = new DatabaseTable($pdo, 'publisher');
	    $authorsTable = new DatabaseTable($pdo, 'authors');

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
        elseif ($route == '') 
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

        return $page;
	}
}