<?php 
namespace Library\Controllers;

class Login 
{
	private $authentication;

	public function __construct(\Framework\Authentication $authentication)	
	{
		$this->authentication = $authentication;
	}

	public function processLogin()
	{
		if ($this->authentication->login($_POST['email'], $_POST['password'])) {
			header('location: /login/success');
		} else {
			return [
				'title'     => 'Error login',
				'template'  => 'login.html.php',
				'variables' => ['error' => 'Invalid email/password.']
			];
		}
	}

	public function loginForm()
	{
		return [
			'title'    => 'Log In',
			'template' => 'login.html.php'
		];
	}

	public function success()
	{
		return [
			'template' => 'loginsuccess.html.php',
			'title'    => 'Login Successful'
		];
	}

	public function error()
	{
		return [
			'title'    => 'You are not logged in',
			'template' => 'errorlogin.html.php'
		];
	}

	public function logout()
	{
		unset($_SESSION);
		return [
			'title'    => 'You have been log out',
			'template' => 'logout.html.php'
		];
	}
}