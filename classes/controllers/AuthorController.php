<?php

class AuthorController {
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable)
	{
		$this->authorsTable = $authorsTable;
	}

	public function home()
	{
		$authors = $this->authorsTable->findAll();

		$title = 'Author list';

		ob_start();

		include __DIR__ . '/../../templates/authors.html.php';

		$output = ob_get_clean();

		return compact('title', 'output');
	}

	public function edit()
	{
		if (isset($_POST['author'])) {
			$this->authorsTable->save($_POST['author']);

			header('location: authors.php');
		} else {
			$title = 'Add a new author';

			if (isset($_GET['id'])) {
				$title = 'Update author';
				$author = $this->authorsTable->findById($_GET['id']);
			}

			ob_start();

			include __DIR__ . '/../../templates/saveauthor.html.php';

			$output = ob_get_clean();
		}

		return compact('title', 'output');
	}

	public function delete()
	{
		$this->authorsTable->delete($_POST['id']);

		header('location: authors.php');
	}
}
