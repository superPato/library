<?php foreach ($authors as $author): ?>
<p>
	<?= htmlspecialchars($author['lastname'], ENT_QUOTES, 'UTF-8') ?>, 
	<?= htmlspecialchars($author['firstname'], ENT_QUOTES, 'UTF-8') ?>
	<span><a href="saveauthor.php?id=<?= $author['id'] ?>">Edit</a></span>
	<form action="deleteauthor.php" method="post">
		<input type="hidden" name="id" value="<?= $author['id'] ?>">
		<button type="submit">Delete</button>
	</form>
</p>	
<?php endforeach; ?>