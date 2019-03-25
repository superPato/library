<?php

class EntryPoint
{
	private $route;

	public function __construct($route)
	{
		$this->route = $route;
	}

	private function checkUrl()
	{
		if ($this->route !== strtolower($this->route)) {
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}

	private function loadTemplate($templateFileName, $variables = [])
	{
	    extract($variables);

	    ob_start();

	    require __DIR__ . "/../templates/{$templateFileName}";

	    return ob_get_clean();
	}

	public function callAction()
	{
		include __DIR__ . '/../includes/DatabaseConnection.php';
	    include __DIR__ . '/../classes/DatabaseTable.php';

	    $booksTable = new DatabaseTable($pdo, 'books');
	    $publishersTable = new DatabaseTable($pdo, 'publisher');
	    $authorsTable = new DatabaseTable($pdo, 'authors');

		if ($this->route == 'books/list') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->list();
        } 
        elseif ($this->route == 'books/edit') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->edit();
        }
        elseif ($this->route == 'books/delete') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->delete();
        }
        elseif ($this->route == '') 
        {
            include __DIR__ . '/../classes/controllers/BookController.php';
            $controller = new BookController($booksTable, $publishersTable);
            $page = $controller->home();
        }
        elseif ($this->route == 'authors/home') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->home();
        }
        elseif ($this->route == 'authors/edit') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->edit();
        }
        elseif ($this->route == 'authors/delete') 
        {
            include __DIR__ . '/../classes/controllers/AuthorController.php';
            $controller = new AuthorController($authorsTable);
            $page = $controller->delete();
        }

        return $page;
	}

	public function run()
	{
		$page = $this->callAction();

		$title = $page['title'];

		$output = isset($page['variables']) 
			? $this->loadTemplate($page['template'], $page['variables'])
			: $this->loadTemplate($page['template']); 

		include __DIR__ . '/../templates/layout.html.php';
	}
}