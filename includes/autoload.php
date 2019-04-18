<?php 

function autoloader($className)
{
	$classPath = str_replace('\\', '/', $className);

	include __DIR__ . "/../classes/{$classPath}.php";
}

spl_autoload_register('autoloader');