<?php  

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "UPDATE authors SET lastname='Pérez' WHERE firstname='Miguel'";

	$affectedRows = $pdo->exec($sql);

	$output = "Updated " . $affectedRows . " rows.";
} catch (PDOException $e) {
	$output = sprintf("Database error: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/output.html.php';