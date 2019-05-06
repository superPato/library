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
		}
		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		if ($valid == true) {
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
