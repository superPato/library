<?php

namespace Library\Controllers;

class Author {
	private $authorsTable;

	public function __construct(\Framework\DatabaseTable $authorsTable)
	{
		$this->authorsTable = $authorsTable;
	}

	public function home()
	{
		$authors = $this->authorsTable->findAll();

		return [
			'title'     => 'Author list', 
			'template'  => 'authors.html.php',
			'variables' => compact('authors')
		];
	}

	public function edit()
	{
		if (isset($_POST['author'])) {
			$this->authorsTable->save($_POST['author']);

			header('location: /authors/home');
		} else {
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
	}

	public function delete()
	{
		$this->authorsTable->delete($_POST['id']);

		header('location: /authors/home');
	}
}
