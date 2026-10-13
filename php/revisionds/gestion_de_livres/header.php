<?php require_once 'auth.php' ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bibliophp</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 1.5rem;
        }
        nav {
            background-color: whitesmoke;
            padding: 0.8rem;
            margin-bottom: 1rem;
        }
        nav a {
            margin-right: 1rem;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 0.0625rem solid gray;
            padding: 0.4rem 0.8rem;
        }
        .erreur {
            color: crimson;
        }
    </style>
</head>
<body>

<nav>
    <?php if(isset($_SESSION['login'])): ?>
    <a href="liste.php">Livres</a>
    <?php if (estAdmin()) : ?>
        <a href="ajouter.php">Ajouter un livre</a>
    <?php endif; ?>
    <a href="logout.php">Déconnexion (<?= htmlspecialchars($_SESSION['login'])?>)</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
    <?php endif; ?>
</nav>




