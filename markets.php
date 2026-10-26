<?php

require "db.php";
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $stmt = $pdo->query("SELECT markets.*, markets.title AS question, markets.outcome AS winning_side, categories.name AS category FROM markets JOIN categories ON markets.category_id = categories.id ORDER BY markets.id DESC");
    $adatok = $stmt->fetchAll();
    echo json_encode($adatok);
}
