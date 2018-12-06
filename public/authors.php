<?php  

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT `id`, `firstname`, `lastname` FROM `authors`";

	$authors = $pdo->query($sql);

	$title = 'Author list';

	ob_start();
	
	include __DIR__ . '/../templates/authors.html.php';

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