<?php 

namespace Framework;

class Authentication {
	private $usersTable;
	private $usernameColumn;
	private $passwordColumn;

	public function __construct(DatabaseTable $usersTable, $usernameColumn, $passwordColumn)
	{
		session_start();
		$this->usersTable = $usersTable;
		$this->usernameColumn = $usernameColumn;
		$this->passwordColumn = $passwordColumn;
	}

	public function login($username, $password): bool
	{
		$user = $this->findUser($username);

		if (! empty($user) && password_verify($password, $user[0]->{$this->passwordColumn})) {
			session_regenerate_id();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $user[0]->{$this->passwordColumn};
			return true;
		} else {
			return false;
		}
	}

	public function isLoggedIn(): bool
	{
		if (empty($_SESSION['username'])) {
			return false;		
		}	

		$user = $this->findUser($_SESSION['username']);

		return (! empty($user) && $_SESSION['password'] === $user[0]->{$this->passwordColumn});
	}

	private function findUser($username)
	{
		return $this->usersTable->find($this->usernameColumn, strtolower($username));
	}

	public function getUser()
	{
		if ($this->isLoggedIn()) {
			return $this->findUser($_SESSION['username'])[0];
		} else {
			return false;
		}
	}

	public function logout()
	{
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		session_regenerate_id();
	}
}