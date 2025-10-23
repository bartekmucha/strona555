<?php
require_once 'config.php';
require_once 'session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (imie, nazwisko, wiek, telefon, adres) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['imie'],
        $_POST['nazwisko'],
        $_POST['wiek'],
        $_POST['telefon'],
        $_POST['adres']
    ]);
}

header("Location: index.php");
exit;
?>
