<?php

namespace Library;

use Framework\Authentication;
use Framework\DatabaseTable;

use Library\Controllers\Book;
use Library\Controllers\Author;
use Library\Controllers\Login;
use Library\Controllers\Register;

class LibraryRoutes implements \Framework\Routes
{
    private $booksTable;
    private $publishersTable;
    private $authorsTable;
    private $usersTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->booksTable      = new DatabaseTable($pdo, 'books');
        $this->publishersTable = new DatabaseTable($pdo, 'publisher');
        $this->authorsTable    = new DatabaseTable($pdo, 'authors');
        $this->usersTable      = new DatabaseTable($pdo, 'users');
        $this->authentication  = new Authentication($this->usersTable, 'email', 'password');
    }

	public function getRoutes(): array
	{
        $bookController   = new Book($this->booksTable, $this->publishersTable);
        $authorController = new Author($this->authorsTable);
        $userController   = new Register($this->usersTable);
        $loginController  = new Login($this->authentication);

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
            ]
        ];
	}

    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }
}