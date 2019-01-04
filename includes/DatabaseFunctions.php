<?php

function query(PDO $pdo, string $sql, array $parameters = [])
{
	$statement = $pdo->prepare($sql);
	$statement->execute($parameters);
	return $statement;
}

function totalBooks(PDO $pdo)
{
    $statement = query($pdo, 'SELECT COUNT(*) FROM `books`');
    return $statement->fetch()[0];
}

function getBook(PDO $pdo, int $id)
{
	$parameters = [':id' => $id];
	$statement = query($pdo, 'SELECT `id`, `title`, `publishingdate`, `publisherid` FROM `books` WHERE `id` = :id', $parameters);

	return $statement->fetch();
}

function allBooks(PDO $pdo)
{
	$result = query($pdo, 'SELECT `books`.`id`, `title`, `name`
				 FROM `books` INNER JOIN `publisher`
					ON `publisherid` = `publisher`.`id`');

	return $result->fetchAll();
}

function insertBook(PDO $pdo, array $fields)
{
	$sql = "INSERT INTO `books` SET ";

	foreach (array_keys($fields) as $key) {
		$sql .= "`{$key}` = :{$key},";
	}
	$sql = rtrim($sql, ',');

	query($pdo, $sql, $fields);
}

function editBook(PDO $pdo, array $fields)
{
	$sql = 'UPDATE `books` SET ';

	foreach (array_keys($fields) as $key) {
		$sql .= "`{$key}` = :{$key},";
	}
	$sql = rtrim($sql, ',');
	$sql .= " WHERE `id` = :id";

	query($pdo, $sql, $fields);
}

function deleteBook(PDO $pdo, int $id)
{
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `books` WHERE `id` = :id', $parameters);
}
