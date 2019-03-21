<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= $title ?></title>
		<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
		<link rel="stylesheet" href="/normalize.css">
		<link rel="stylesheet" href="/app.css">
	</head>
	<body>
		<nav class="main grouping">
				<h1><a href="/">Store Book</a></h1>
				<ul class="primary-nav">
					<li><a href="index.php">Home</a></li>
					<li class="has-submenu">
						<a href="/books/list">Books</a>
						<ul>
							<li><a href="/books/edit">Add Book</a></li>
						</ul>
					</li>
					<li class="has-submenu">
						<a href="/authors/home">Authors</a>
						<ul>
							<li><a href="/authors/edit">Add Author</a></li>
						</ul>
					</li>
				</ul>
		</nav>
		<div class="container">
			<main>
				<h2><?= $title ?></h2>
				<?= $output ?>
			</main>
		</div>
		<footer class="main">
			<p>Library &copy;library.com</p>
		</footer>
	</body>
</html>
