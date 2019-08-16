<?php 
namespace Library\Entity;

class Publisher {
	public $id;
	public $name;
	public $phone;
	public $email;
	private $booksTable;

	public function __construct(\Framework\DatabaseTable $booksTable)
	{
		$this->booksTable = $booksTable;
	}

	public function getBooks()
	{
		return $this->booksTable->find('publisherid', $this->id);
	}

	public function addJoke($book)
	{
		$book['publisherid'] = $this->id;

		$this->booksTable->save($book);
	}
}