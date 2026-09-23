<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM livres ORDER BY id DESC");
$livres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
</head>
<body>

<h1>Liste des livres</h1>

<a href="ajouter.php">Ajouter un livre</a>

<table border="1">
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Année</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($livres as $livre): ?>
        <tr>
            <td><?= htmlspecialchars($livre['titre']) ?></td>
            <td><?= htmlspecialchars($livre['auteur']) ?></td>
            <td><?= htmlspecialchars($livre['annee']) ?></td>
            <td>
                <a href="editer.php?id=<?= $livre['id'] ?>">Éditer</a>
                <a href="supprimer.php?id=<?= $livre['id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>