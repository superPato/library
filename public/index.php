<?php  

try {
	$pdo = new PDO('mysql:host=localhost;dbname=librar;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$output = "Database connection established";
} catch (PDOException $e) {
	$output = "Unable to connect to the database server: " .
		$e->getMessage() . ' in ' .
		$e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php';