<?php foreach ($books as $book): ?>
<p>
	<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>
	<form action="deletebook.php" method="POST">
		<input type="hidden" name="id" value="<?= $book['id'] ?>">
		<button type="submit">Delete</button>
	</form>
</p>	
<?php endforeach ?>