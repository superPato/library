<?php

function query(PDO $pdo, string $sql, array $parameters = [])
{
	$statement = $pdo->prepare($sql);
	$statement->execute($parameters);
	return $statement;
}

function total(PDO $pdo, string $table)
{
    $statement = query($pdo, "SELECT COUNT(*) FROM {$table}");
    return $statement->fetch()[0];
}

function findById(PDO $pdo, string $table, $valueId,  string $primaryKey = 'id')
{
	$parameters = [':id' => $valueId];
	$statement = query($pdo, "SELECT * FROM {$table} WHERE `{$primaryKey}` = :id", $parameters);

	return $statement->fetch();
}

function findAll(PDO $pdo, string $table)
{
	return query($pdo, "SELECT * FROM `{$table}`")->fetchAll();
}

function insert(PDO $pdo, string $table, array $fields)
{
	$placeholders = getStringPlaceholders($fields);
	$sql = "INSERT INTO `{$table}` SET {$placeholders}";

	query($pdo, $sql, $fields);
}

function edit(PDO $pdo, string $table, array $fields, string $primaryKey = 'id')
{
	$placeholders = getStringPlaceholders($fields);
	$sql = "UPDATE `{$table}` SET {$placeholders} WHERE `{$primaryKey}` = :{$primaryKey}";

	query($pdo, $sql, $fields);
}

function delete(PDO $pdo, string $table, $id, string $primaryKey = 'id')
{
	$parameters = [':id' => $id];

	query($pdo, "DELETE FROM `{$table}` WHERE `{$primaryKey}` = :id", $parameters);
}

function getStringPlaceholders($fields)
{
	$placeholders = '';
	foreach (array_keys($fields) as $key) {
		$placeholders .= "`{$key}` = :{$key},";
	}

	return rtrim($placeholders, ',');
}
