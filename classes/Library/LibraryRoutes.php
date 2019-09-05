<?php

namespace Library;

use Framework\Authentication;
use Framework\DatabaseTable;

use Library\Controllers\Book;
use Library\Controllers\Author;
use Library\Controllers\Login;
use Library\Controllers\Register;
use Library\Controllers\Tag;

class LibraryRoutes implements \Framework\Routes
{
    private $booksTable;
    private $publishersTable;
    private $authorsTable;
    private $usersTable;
    private $tagsTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->booksTable      = new DatabaseTable($pdo, 'books', 'id', \Library\Entity\Book::class, [&$this->publishersTable, &$this->authorsTable]);
        $this->publishersTable = new DatabaseTable($pdo, 'publisher', 'id', \Library\Entity\Publisher::class, [&$this->booksTable]);
        $this->authorsTable    = new DatabaseTable($pdo, 'authors', 'id', \Library\Entity\Author::class, [&$this->booksTable]);
        $this->tagsTable       = new DatabaseTable($pdo, 'tags', 'id');
        $this->usersTable      = new DatabaseTable($pdo, 'users');
        $this->authentication  = new Authentication($this->usersTable, 'email', 'password');
    }

	public function getRoutes(): array
	{
        $bookController   = new Book($this->booksTable, $this->authorsTable, $this->publishersTable, $this->authentication);
        $authorController = new Author($this->authorsTable, $this->authentication);
        $userController   = new Register($this->usersTable);
        $loginController  = new Login($this->authentication);
        $tagController    = new Tag($this->tagsTable, $this->authentication);

        return [
            'books/edit' => [
                'POST' => [
                    'controller' => $bookController,
                    'action'     => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $bookController,
                    'action'     => 'edit'
                ],
                'login' => true
            ],
            'books/delete' => [
                'POST' => [
                    'controller' => $bookController,
                    'action'    => 'delete'
                ],
                'login' => true
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
                ],
                'login' => true
            ],
            'authors/delete' => [
                'POST' => [
                    'controller' => $authorController,
                    'action'     => 'delete'
                ],
                'login' => true
            ],
            'authors/home' => [
                'GET' => [
                    'controller' => $authorController,
                    'action'    => 'home'
                ]
            ],
            'users/register' => [
                'POST' => [
                    'controller' => $userController,
                    'action'     => 'registerUser'
                ],
                'GET' => [
                    'controller' => $userController,
                    'action'     => 'registerForm'
                ]
            ],
            'users/success' => [
                'GET' => [
                    'controller' => $userController,
                    'action'     => 'success'
                ]
            ],
            'login' => [
                'POST' => [
                    'controller' => $loginController,
                    'action'     => 'processLogin'
                ],
                'GET' => [
                    'controller' => $loginController,
                    'action'     => 'loginForm'
                ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ],
                'login' => true
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action'     => 'success'
                ],
                'login' => true
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action'     => 'error'
                ]
            ],
            'tags/list' => [
                'GET' => [
                    'controller' => $tagController,
                    'action'     => 'list'
                ]
            ],
            'tags/edit' => [
                'GET' => [
                    'controller' => $tagController,
                    'action'     => 'edit'
                ],
                'POST' => [
                    'controller' => $tagController,
                    'action'     => 'saveEdit'
                ],
                'login' => true
            ],
            'tags/delete' => [
                'POST' => [
                    'controller' => $tagController,
                    'action'     => 'delete'
                ],
                'login' => true
            ],
        ];
	}

    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }
}