<?php

namespace Library\Controllers;

use Framework\Authentication;
use Framework\DatabaseTable;

class Author {
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable, Authentication $authentication)
	{
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;
	}

	public function home()
	{
		$authors = $this->authorsTable->findAll();
		$isLoggedIn = $this->authentication->isLoggedIn();

		return [
			'title'     => 'Author list', 
			'template'  => 'authors.html.php',
			'variables' => compact('authors', 'isLoggedIn')
		];
	}

	public function saveEdit()
	{
		$this->authorsTable->save($_POST['author']);

		header('location: /authors/home');
	}

	public function edit()
	{
		$title = 'Add a new author';

		if (isset($_GET['id'])) {
			$title = 'Update author';
			$author = $this->authorsTable->findById($_GET['id']);
		}

		return [
			'title'     => $title,
			'template'  => 'saveauthor.html.php',
			'variables' => [
				'author' => $author ?? null,
			]
		];
	}

	public function delete()
	{
		$this->authorsTable->delete($_POST['id']);

		header('location: /authors/home');
	}
}
