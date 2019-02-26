<p class="text-right"><?= $totalBooks ?> books has been submitted.</p>

<?php foreach ($books as $book): ?>
<p>
	<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>
	<span>Publisher - <?= htmlspecialchars($book['name'], ENT_QUOTES, 'UTF-8') ?></span>

	<a href="index.php?action=edit&id=<?= $book['id'] ?>">Edit</a>

	<form action="index.php?action=delete" method="POST">
		<input type="hidden" name="id" value="<?= $book['id'] ?>">
		<button type="submit">Delete</button>
	</form>
</p>

<hr>
<?php endforeach ?>
