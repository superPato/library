<?php

if (isset($_POST['firstname'])) {
	try {
		include __DIR__ . '/../includes/DatabaseConnection.php';

		$sql = 'INSERT INTO authors SET
					firstname = :firstname,
					lastname = :lastname';

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':firstname', $_POST['firstname']);
		$stmt->bindValue(':lastname', $_POST['lastname']);

		$stmt->execute();

		header('location: authors.php');
	} catch (PDOException $e) {
		$title = 'An error has ocurred';

		$output = sprintf("Database error: %s in %s:%s",
			$e->getMessage(),
			$e->getFile(),
			$e->getLine()
		);
	}
} else {
	$title = 'Add a new author';

	ob_start();

	include __DIR__ . '/../templates/addauthor.html.php';

	$output = ob_get_clean();
}

include __DIR__ . '/../templates/layout.html.php';
