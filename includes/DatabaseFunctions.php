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

function insertBook(PDO $pdo, string $title, string $publishingdate, int $publisherid)
{
	$parameters = [
		':title' => $title,
		':publishingdate' => $publishingdate,
		':publisherid' => $publisherid,
	];

	$sql = 'INSERT INTO `books` SET `title` = :title, `publishingdate` = :publishingdate, `publisherid` = :publisherid';

	query($pdo, $sql, $parameters);
}

function editBook(PDO $pdo, int $bookid, string $title, string $publishingdate, string $publisherid)
{
	$parameters = [
		':bookid' => $bookid,
		':title' => $title,
		':publishingdate' => $publishingdate,
		':publisherid' => $publisherid,
	];

	$sql = 'UPDATE `books` SET
		`title` = :title,
		`publishingdate` = :publishingdate,
		`publisherid` = :publisherid
		WHERE `id` = :bookid';

	query($pdo, $sql, $parameters);
}

function deleteBook(PDO $pdo, int $id)
{
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `books` WHERE `id` = :id', $parameters);
}