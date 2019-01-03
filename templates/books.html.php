<p><?= $totalBooks ?> books has been submitted.</p>

<?php foreach ($books as $book): ?>
<p>
	<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>
	<span>Publisher - <?= htmlspecialchars($book['name'], ENT_QUOTES, 'UTF-8') ?></span>

	<a href="editbook.php?id=<?= $book['id'] ?>">Edit</a>

	<form action="deletebook.php" method="POST">
		<input type="hidden" name="id" value="<?= $book['id'] ?>">
		<button type="submit">Delete</button>
	</form>
</p>
<?php endforeach ?>
