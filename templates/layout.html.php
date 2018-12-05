<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= $title ?></title>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="authors.php">Authors</a></li>
				<li><a href="addauthor.php">Add Author</a></li>
			</ul>
		</nav>
		<main>
			<?= $output ?>
		</main>
		<footer>
			<p>Library &copy;library.com</p>
		</footer>
	</body>
</html>