<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Profil</title></head>
<body>
<h1>Bonjour <?= htmlspecialchars($_SESSION['login']) ?></h1>
<a href="logout.php">Déconnexion</a>
</body>
</html>