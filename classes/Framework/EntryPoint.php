<?php

namespace Framework;

class EntryPoint
{
	private $route;
	private $method;
    private $routes;

	public function __construct($route, $method, Routes $routes)
	{
		$this->route = $route;
		$this->method = $method;
        $this->routes = $routes;

        $this->checkUrl();
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

	    require __DIR__ . "/../../templates/{$templateFileName}";

	    return ob_get_clean();
	}

	public function run()
	{
		$routes = $this->routes->getRoutes();
		$authentication = $this->routes->getAuthentication();

		if (isset($routes[$this->route]['login']) && ! $authentication->isLoggedIn()) {
			header('location: /login/error');
		} 
		else
		{
	        $controller = $routes[$this->route][$this->method]['controller'];
	        $method = $routes[$this->route][$this->method]['action'];
	        $page = $controller->$method();

			$title = $page['title'];

			$output = isset($page['variables']) 
				? $this->loadTemplate($page['template'], $page['variables'])
				: $this->loadTemplate($page['template']); 

			echo $this->loadTemplate('layout.html.php', [
				'loggedIn' => $authentication->isLoggedIn(),
				'output'   => $output,
				'title'    => $title,
			]);
		}
	}
}