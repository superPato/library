<?php  

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "CREATE TABLE authors (
		id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY kEY,
		firstname VARCHAR(200),
		lastname VARCHAR(200),
		version INTEGER NOT NULL
	) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB";

	$pdo->exec($sql);

	$output = "authos table successfully created.";
} catch (PDOException $e) {
	$output = sprintf("Database error: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/output.html.php';