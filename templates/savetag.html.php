<form action="" method="post">
	<input type="hidden" name="tag[id]" value="<?= $tag->id ?? '' ?>">
	<div>
	    <label for="name">Name</label>
	    <input type="text" name="tag[name]" id="name" value="<?= $tag->name ?? '' ?>">
	</div>
	<input type="submit" value="Save">
</form>