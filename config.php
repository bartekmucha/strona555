<?php
$host = '10.10.10.3';
$db   = 'admin_panel';
$user = 'admin';
$pass = 'Touch24k0pl8&';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Błąd połączenia z bazą: " . $e->getMessage());
}
?>
