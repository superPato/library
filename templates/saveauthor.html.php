<form action="" method="POST">
	<input type="hidden" name="author[id]" value="<?= $author['id'] ?? '' ?>">
	<div>
		<label for="firstname">First Name:</label>
		<input type="text" name="author[firstname]" value="<?= $author['firstname'] ?? '' ?>" id="firstname">
	</div>
	<div>
		<label for="lastname">Last Name:</label>
		<input type="text" name="author[lastname]" value="<?= $author['lastname'] ?? '' ?>" id="lastname">
	</div>
	<br>
	<button type="submit" name="submit">Save</button>
</form>