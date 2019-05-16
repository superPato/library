<?php 
namespace Framework;

interface Routes 
{
	public function getRoutes(): array;
	public function getAuthentication(): Authentication;
}