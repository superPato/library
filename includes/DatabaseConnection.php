<?php

$pdo = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'library', 'library');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
