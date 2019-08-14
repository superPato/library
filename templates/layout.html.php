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
					<li><a href="/">Home</a></li>
					<li class="has-submenu">
						<a href="/books/list">Books</a>
						<ul>
							<?php if ($loggedIn): ?>
							<li><a href="/books/edit">Add Book</a></li>
							<?php endif ?>
						</ul>
					</li>
					<li class="has-submenu">
						<a href="/authors/home">Authors</a>
						<ul>
							<?php if ($loggedIn): ?>
							<li><a href="/authors/edit">Add Author</a></li>
							<?php endif ?>
						</ul>
					</li>
					<?php if ($loggedIn): ?>
					<li><a href="/logout">Log Out</a></li>	
					<?php else: ?>
					<li><a href="/login">Log In</a></li>	
					<?php endif ?>
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
