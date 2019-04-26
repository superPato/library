<?php

namespace Library;

use Framework\DatabaseTable;

use Library\Controllers\Book;
use Library\Controllers\Author;

class LibraryRoutes implements \Framework\Routes
{
	public function getRoutes()
	{
		include __DIR__ . '/../../includes/DatabaseConnection.php';

	    $booksTable = new DatabaseTable($pdo, 'books');
	    $publishersTable = new DatabaseTable($pdo, 'publisher');
	    $authorsTable = new DatabaseTable($pdo, 'authors');

        $bookController = new Book($booksTable, $publishersTable);
        $authorController = new Author($authorsTable);

        return [
            'books/edit' => [
                'POST' => [
                    'controller' => $bookController,
                    'action'     => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $bookController,
                    'action'     => 'edit'
                ]
            ],
            'books/delete' => [
                'POST' => [
                    'controller' => $bookController,
                    'action'    => 'delete'
                ]
            ],
            'books/list' => [
                'GET' => [
                    'controller' => $bookController,
                    'action'     => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $bookController,
                    'action'     => 'home'
                ]
            ],
            'authors/edit' => [
                'POST' => [
                    'controller' => $authorController,
                    'action'     => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $authorController,
                    'action'     => 'edit'
                ]
            ],
            'authors/delete' => [
                'POST' => [
                    'controller' => $authorController,
                    'action'     => 'delete'
                ]
            ],
            'authors/home' => [
                'GET' => [
                    'controller' => $authorController,
                    'action'    => 'home'
                ]
            ]
        ];
	}
}