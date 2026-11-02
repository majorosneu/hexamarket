<?php

require "db.php";
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $azonosito = $_GET["id"];
    $stmt = $pdo->prepare("SELECT *, created_at AS recorded_at FROM price_history WHERE market_id = ? ORDER BY created_at, id");
    $stmt->execute([$azonosito]);
    $adatok = $stmt->fetchAll();
    echo json_encode($adatok);
}
