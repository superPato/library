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
	$statement = query($pdo, 'SELECT `title`, `publishingdate` FROM `books` WHERE `id` = :id', $parameters);

	return $statement->fetch();
}
