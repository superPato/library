<?php

function totalBooks(PDO $pdo)
{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM `books`');
    $stmt->execute();

    return $stmt->fetch()[0];
}
