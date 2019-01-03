<form action="" method="post">
	<input type="hidden" name="bookid" value="<?= $book['id'] ?>">

	<div>
		<label for="title">Title</label>
		<input type="text" name="title" id="title" value="<?= $book['title'] ?>">
	</div>
	<div>
		<label for="publishingdate">Publishing Date</label>
		<input type="date" name="publishingdate" id="title" value="<?= $book['publishingdate'] ?>">
	</div>
	<div>
		<label for="publisherid">Publisher</label>
		<select name="publisherid" id="publisherid">
			<?php foreach ($publishers as $publisher): ?>
			<option value="<?= $publisher['id'] ?>" <?php echo $publisher['id'] == $book['publisherid'] ? 'selected' : ''?>>
				<?= $publisher['name'] ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>
	<button type="submit">Update</button>
</form>
