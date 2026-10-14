<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php?error=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Administration</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
        }
    </style>
</head>
<body>

<h1>Bonjour <?= htmlspecialchars($_SESSION['login']) ?></h1>
<p>Cette page est réservée aux utilisateurs connectés.</p>
<a href="logout.php">Déconnexion</a>

</body>
</html>