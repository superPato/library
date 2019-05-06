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

		$this->usersTable->save($user);

		header('Location: /users/success');
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
