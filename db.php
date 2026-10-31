<?php

session_name("hexamarket_nemkesz");
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hexamarket";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
}
catch (PDOException $e) {
    echo "Sikertelen kapcsolódás";
}
