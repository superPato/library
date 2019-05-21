<?php if (isset($error)): ?>
<div class="errors"><?= $error ?></div>
<?php endif ?>

<form action="" method="post">
	<div>
		<label for="email">Your email address</label>
		<input type="email" name="email" id="email">
	</div>

	<div>
		<label for="password">Your password</label>
		<input type="password" name="password" id="password">
	</div>

	<button type="submit">Log In</button>
</form>

<p>Don't have an account? <a href="/author/register">Click here to register an account</a></p>