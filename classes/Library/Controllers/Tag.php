<?php
namespace Library\Controllers;

use Framework\Authentication;
use Framework\DatabaseTable;

class Tag {
	private $tagsTable;
	private $authentication;

	public function __construct(DatabaseTable $tagsTable, Authentication $authentication)
	{
		$this->tagsTable = $tagsTable;
		$this->authentication = $authentication;
	}

	public function list()
	{
		$tags = $this->tagsTable->findAll();
		$isLoggedIn = $this->authentication->isLoggedIn();

		return [
			'title'     => 'Tags',
			'template'  => 'tags.html.php',
			'variables' => compact('tags', 'isLoggedIn')
		];
	}

	public function edit()
	{
		$title = 'Add Tag';

		if (isset($_GET['id'])) {
			$title = 'Update Tag';
			$tag = $this->tagsTable->findById($_GET['id']);
		}

		return [
			'title' => $title,
			'template' => 'savetag.html.php',
			'variables' => [
				'tag' => $tag ?? null 
			]
		];
	}

	public function saveEdit()
	{
		$this->tagsTable->save($_POST['tag']);

		header('location: /tags/list');
	}

	public function delete()
	{
		$this->tagsTable->delete($_POST['id']);

		header('location: /tags/list');
	}
}