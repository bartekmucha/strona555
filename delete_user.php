<?php
require_once 'config.php';
require_once 'session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: index.php");
exit;
?>
