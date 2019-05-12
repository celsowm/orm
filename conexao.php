<?php

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn       = "mysql:host=localhost;dbname=livraria;charset=utf8";
$user      = "root";
$senha     = '';

$pdo = new PDO($dsn, $user, $senha, $options);