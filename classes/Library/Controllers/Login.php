<?php 
namespace Library\Controllers;

class Login 
{
	public function error()
	{
		return [
			'title'    => 'You are not logged in',
			'template' => 'errorlogin.html.php'
		];
	}
}