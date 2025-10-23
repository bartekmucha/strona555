<?php
require_once 'config.php';
require_once 'session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel główny</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h2>Panel główny</h2>
    <p><strong>Użytkownik:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
    <a href="logout.php">Wyloguj</a>
</div>

<h3>Lista użytkowników</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Wiek</th>
        <th>Telefon</th>
        <th>Adres</th>
        <th>Akcje</th>
    </tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['imie']) ?></td>
            <td><?= htmlspecialchars($u['nazwisko']) ?></td>
            <td><?= htmlspecialchars($u['wiek']) ?></td>
            <td><?= htmlspecialchars($u['telefon']) ?></td>
            <td><?= htmlspecialchars($u['adres']) ?></td>
            <td><a href="delete_user.php?id=<?= $u['id'] ?>">Usuń</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Dodaj użytkownika</h3>
<form method="post" action="add_user.php">
    <input type="text" name="imie" placeholder="Imię" required>
    <input type="text" name="nazwisko" placeholder="Nazwisko" required>
    <input type="number" name="wiek" placeholder="Wiek" required>
    <input type="text" name="telefon" placeholder="Telefon" required>
    <input type="text" name="adres" placeholder="Adres" required>
    <button type="submit">Dodaj</button>
</form>
</body>
</html>
