<?php foreach ($authors as $author): ?>
<p>
	<?= htmlspecialchars($author['lastname'], ENT_QUOTES, 'UTF-8') ?>, 
	<?= htmlspecialchars($author['firstname'], ENT_QUOTES, 'UTF-8') ?>
</p>	
<?php endforeach; ?>