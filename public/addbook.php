<?php

if (isset($_POST['title'])) {
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'INSERT INTO `books` SET 
					`title` = :title, 
					`publishingdate` = CURDATE(), 
					`publisherid` = :publisherid';

		$statement = $pdo->prepare($sql);

		$statement->bindValue(':title', $_POST['title']);
		$statement->bindValue(':publisherid', $_POST['publisherid']);

		$statement->execute();

		header('location: books.php');
	} catch (PDOException $e) {
		$title = 'An error has ocurred';

		$output = sprintf('Error in database: %s %s:%s',
			$e->getMessage(),
			$e->getFile(),
			$e->getLine()
		);
	}
} else {
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$publishers = $pdo->query('SELECT `id`, `name` FROM `publisher`');

		$title = 'Add Book';

		ob_start();

		include __DIR__ . '/../templates/addbook.html.php';

		$output = ob_get_clean();
	} catch (PDOException $e) {
		$title = 'An error has ocurred';

		$output = sprintf('Error in database: %s %s:%s',
			$e->getMessage(),
			$e->getFile(),
			$e->getLine()
		);
	}
}

include __DIR__ . '/../templates/layout.html.php';