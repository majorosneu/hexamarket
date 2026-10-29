<?php

require "db.php";
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_adatok = json_decode(file_get_contents("php://input"), true);
    $muvelet = $json_adatok["muvelet"];
    $email = $json_adatok["email"];
    $jelszo = $json_adatok["jelszo"];

    if ($muvelet == "regisztracio") {
        $nev = $json_adatok["nev"];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $nev]);
        $adatok = $stmt->fetchAll();

        if ($nev == "" || $email == "" || $jelszo == "") {
            echo json_encode(["hiba" => "Minden mezőt tölts ki!"]);
        } else {
            if (count($adatok) > 0) {
                echo json_encode(["hiba" => "Ez a név vagy e-mail-cím már foglalt."]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$nev, $email, $jelszo]);
                echo json_encode(["uzenet" => "Sikeres regisztráció."]);
            }
        }
    }
}
