<form action="" method="post">
	<input type="hidden" name="book[id]" value="<?= $book->id ?? '' ?>">

	<div>
		<label for="title">Title</label>
		<input type="text" name="book[title]" id="title" value="<?= $book->title ?? '' ?>">
	</div>
	<div>
		<label for="publishingdate">Publishing Date</label>
		<input type="date" name="book[publishingdate]" id="title" value="<?= $book->publishingdate ?? '' ?>">
	</div>
	<div>
		<label for="publisherid">Publisher</label>
		<select name="book[publisherid]" id="publisherid">
			<?php foreach ($publishers as $publisher): ?>
			<option value="<?= $publisher->id ?>"
				<?php if (isset($book->publisherid) && $book->publisherid == $publisher->id) echo "selected" ?>
				>
				<?= $publisher->name ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>
    <div>
        <label for="authorid">Author</label>
        <select name="book[authorid]" id="authorid">
            <?php foreach ($authors as $author): ?>
            <option value="<?= $author->id ?>"
                <?php if (isset($book->authorid) && $book->authorid == $author->id) echo "selected" ?>>
                <?= $author->name() ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <?php foreach ($tags as $tag): ?>
        <label for="<?= $tag->name ?>"><?= $tag->name ?></label>
        <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" id="<?= $tag->name ?>">
        <?php endforeach; ?>
    </div>
	<button type="submit" name="submit">Save</button>
</form>
