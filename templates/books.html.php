<p class="text-right"><?= $totalBooks ?> books has been submitted.</p>

<div class="sidebar">
    <ul>
        <?php foreach ($tags as $tag): ?>
        <li><a href="/books/list?tag=<?= $tag->id ?>"><?= $tag->name ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php foreach ($books as $book): ?>
<p>
	<?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>
	<span>Publisher - <?= htmlspecialchars($book->getPublisher()->name, ENT_QUOTES, 'UTF-8') ?></span>
    <span class="author"><?= $book->getAuthor()->name() ?></span>

	<?php if ($isLoggedIn): ?>

	<a href="/books/edit?id=<?= $book->id ?>">Edit</a>

	<form action="/books/delete" method="POST">
		<input type="hidden" name="id" value="<?= $book->id ?>">
		<button type="submit">Delete</button>
	</form>

	<?php endif; ?>
</p>

<hr>
<?php endforeach ?>
