<?php

require "db.php";
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $felhasznalo = null;
    if (!empty($_SESSION["user_id"])) {
        $stmt = $pdo->prepare("SELECT id, username, email, balance FROM users WHERE id = ?");
        $stmt->execute([$_SESSION["user_id"]]);
        $adatok = $stmt->fetchAll();
        if (count($adatok) > 0) { $felhasznalo = $adatok[0]; }
    }
    echo json_encode(["felhasznalo" => $felhasznalo]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_adatok = json_decode(file_get_contents("php://input"), true);
    $muvelet = $json_adatok["muvelet"];
    if ($muvelet == "kilepes") {
        session_unset();
        session_destroy();
        echo json_encode(["siker" => true]);
        exit;
    }
    $email = $json_adatok["email"];
    $jelszo = $json_adatok["jelszo"];

    if ($muvelet == "belepes") {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $adatok = $stmt->fetchAll();

        if (count($adatok) == 0) {
            echo json_encode(["hiba" => "Nincs ilyen felhasználó."]);
        } else {
            if ($jelszo === $adatok[0]["password"]) {
                session_regenerate_id(true);
                $_SESSION["user_id"] = $adatok[0]["id"];
                $stmt = $pdo->prepare("SELECT id, username, email, balance FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $felhasznalo = $stmt->fetchAll();
                echo json_encode(["felhasznalo" => $felhasznalo[0]]);
            } else {
                echo json_encode(["hiba" => "Hibás jelszó."]);
            }
        }
    }

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
