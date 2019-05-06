<?php if (! empty($errors)): ?>
<div class="errors">
	<p>You must check the next fields:</p>
	<ul>
	<?php foreach ($errors as $error): ?>
		<li><?= $error ?></li>
	<?php endforeach ?>
	</ul>
</div>	
<?php endif ?>

<form action="" method="post">
	<div>
		<label for="name">Name</label>
		<input type="text" name="user[name]" id="name" value="<?= $user['name'] ?? ''?>">
	</div>

	<div>
		<label for="emal">Email</label>
		<input type="email" name="user[email]" id="email" value="<?= $user['email'] ?? '' ?>">
	</div>

	<div>
		<label for="password">Password</label>
		<input type="password" name="user[password]" id="password" value="<?= $user['password'] ?? '' ?>">
	</div>

	<input type="submit" name="submit" value="Register">
</form>