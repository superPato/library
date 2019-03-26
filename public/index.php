<?php

try {
    include __DIR__ . '/../classes/EntryPoint.php';
    include __DIR__ . '/../classes/LibraryRoutes.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route, new LibraryRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has ocurred.';

	$output = sprintf('Error to connect to database server: %s in %s:%s',
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
    
    include __DIR__ . '/../templates/layout.html.php';
}

