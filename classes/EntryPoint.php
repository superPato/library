<?php

class EntryPoint
{
	private $route;
    private $routes;

	public function __construct($route, $routes)
	{
		$this->route = $route;
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

	    require __DIR__ . "/../templates/{$templateFileName}";

	    return ob_get_clean();
	}

	public function run()
	{
		$page = $this->routes->callAction($this->route);

		$title = $page['title'];

		$output = isset($page['variables']) 
			? $this->loadTemplate($page['template'], $page['variables'])
			: $this->loadTemplate($page['template']); 

		include __DIR__ . '/../templates/layout.html.php';
	}
}