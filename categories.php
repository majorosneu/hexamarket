<?php

require "db.php";
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY id");
    $adatok = $stmt->fetchAll();
    echo json_encode($adatok);
}
