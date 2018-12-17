<form action="" method="POST">
	<div>
		<label for="title">Title</label>
		<input type="text" name="title" id="title">
	</div>
	<div>
		<label for="publisher">Publisher</label>
		<select name="publisherid" id="publisher">
		<?php foreach ($publishers as $publisher): ?>
			<option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<button type="submit">Add</button>
</form>