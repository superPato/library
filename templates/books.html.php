<?php foreach ($books as $book): ?>
<p>
	<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>
</p>	
<?php endforeach ?>