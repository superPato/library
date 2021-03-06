<?php 

namespace Library\Controllers;

class Register {
	private $usersTable;

	public function __construct(\Framework\DatabaseTable $usersTable)
	{
		$this->usersTable = $usersTable;
	}

	public function registerUser()
	{
		$user = $_POST['user'];

		$valid = true;
		$errors = [];

		if (empty($user['name'])) {
			$valid = false;
			$errors[] = 'Name cannot be blank';
		}

		if (empty($user['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		} elseif (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		} else {
			$user['email'] = strtolower($user['email']);

			if (count($this->usersTable->find('email', $user['email'])) > 0) {
				$valid = false;
				$errors[] = 'This email has taken already.';
			}
		}

		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		if ($valid == true) {
			// Hash the password before saving it in the database
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

			$this->usersTable->save($user);

			header('Location: /users/success');
		} else {
			return [
				'template'  => 'register.html.php',
				'title'     => 'Register an account',
				'variables' => [
					'errors' => $errors,
					'user'   => $user
				]
			];
		}
	}

	public function registerForm()
	{
		return [
			'template' => 'register.html.php',
			'title' => 'Register user'
		];
	}

	public function success()
	{
		return [
			'template' => 'registersuccess.html.php',
			'title' => 'Registration Successful'
		];
	}
}
