<?php  

try {
	$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT `firstname`, `lastname` FROM `authors`";

	$result = $pdo->query($sql);

	while ($row = $result->fetch()) {
		$authors[] = ['firstname' => $row['firstname'], 'lastname' => $row['lastname']];
	}
} catch (PDOException $e) {
	$error = sprintf("Unable to connect to database server: %s in %s:%x",
		$e->getMessage(),
		$e->getFile(),
		$e->getLine()
	);
}

include __DIR__ . '/../templates/output.html.php';