<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>List of Authors</title>
	</head>
	<body>
		<?php if (isset($error)): ?>
		<p><?= $error ?></p>	
		<?php else: ?>
			<?php foreach ($authors as $author): ?>
				<blockquote>
					<p>
						<?= htmlspecialchars($author['lastname'], ENT_QUOTES, 'UTF-8') . 
							', ' . 
							htmlspecialchars($author['firstname'], ENT_QUOTES, 'UTF-8') ?>
					</p>
				</blockquote>
			<?php endforeach ?>
		<?php endif ?>
	</body>
</html>