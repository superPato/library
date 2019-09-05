<?php foreach ($tags as $tag): ?>
<p>
    <?= $tag->name ?>

    <?php if ($isLoggedIn): ?>
    <a href="/tags/edit?id=<?= $tag->id ?>">Editar</a>
    <form action="/tags/delete" method="post">
    	<input type="hidden" name="id" value="<?= $tag->id ?>">
    	<input type="submit" value="Delete">
    </form>
    <?php endif; ?>
</p>
<?php endforeach; ?>