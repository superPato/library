<?php foreach ($authors as $author): ?>
<p>
	<?= htmlspecialchars($author->name(), ENT_QUOTES, 'UTF-8') ?>

	<?php if ($isLoggedIn): ?>
	<span><a href="/authors/edit?id=<?= $author->id ?>">Edit</a></span>
	<form action="/authors/delete" method="post">
		<input type="hidden" name="id" value="<?= $author->id ?>">
		<button type="submit">Delete</button>
	</form>
	<?php endif; ?>
</p>
<?php endforeach; ?>
