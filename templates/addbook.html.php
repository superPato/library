<h2>Add Book</h2>

<form action="" method="POST" class="form">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" id="title" class="form-control">
	</div>
	<div class="form-group">
		<label for="publishingdate">Publishing Date</label>
		<input type="date" name="publishingdate" id="publishingdate" class="form-control">
	</div>
	<div class="form-group">
		<label for="publisher">Publisher</label>
		<select name="publisherid" id="publisher" class="form-control">
		<?php foreach ($publishers as $publisher): ?>
			<option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Add</button>
</form>