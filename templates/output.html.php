<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>List of Authors</title>
	</head>
	<body>
		<?php if (isset($error)): ?>
		<p><?php echo $error ?></p>	
		<?php else: ?>
			<?php foreach ($authors as $author): ?>
				<blockquote>
					<p><?php echo $author['lastname'] . ', ' . $author['firstname'] ?></p>
				</blockquote>
			<?php endforeach ?>
		<?php endif ?>
	</body>
</html>