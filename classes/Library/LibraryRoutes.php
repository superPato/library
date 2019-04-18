<?php

namespace Library;

use Framework\DatabaseTable;

use Library\Controllers\Book;
use Library\Controllers\Author;

class LibraryRoutes 
{
	public function callAction($route)
	{
		include __DIR__ . '/../../includes/DatabaseConnection.php';

	    $booksTable = new DatabaseTable($pdo, 'books');
	    $publishersTable = new DatabaseTable($pdo, 'publisher');
	    $authorsTable = new DatabaseTable($pdo, 'authors');

		if ($route == 'books/list') 
        {
            $controller = new Book($booksTable, $publishersTable);
            $page = $controller->list();
        } 
        elseif ($route == 'books/edit') 
        {
            $controller = new Book($booksTable, $publishersTable);
            $page = $controller->edit();
        }
        elseif ($route == 'books/delete') 
        {
            $controller = new Book($booksTable, $publishersTable);
            $page = $controller->delete();
        }
        elseif ($route == '') 
        {
            $controller = new Book($booksTable, $publishersTable);
            $page = $controller->home();
        }
        elseif ($route == 'authors/home') 
        {
            $controller = new Author($authorsTable);
            $page = $controller->home();
        }
        elseif ($route == 'authors/edit') 
        {
            $controller = new Author($authorsTable);
            $page = $controller->edit();
        }
        elseif ($route == 'authors/delete') 
        {
            $controller = new Author($authorsTable);
            $page = $controller->delete();
        }

        return $page;
	}
}