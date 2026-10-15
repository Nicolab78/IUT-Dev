<?php
require __DIR__ . '/db.php';
$connexion = connecter();

$q = trim($_GET['q'] ?? '');
$motif = '%' . $q . '%';

$sql = 'SELECT l.titre, l.annee, a.nom AS auteur
        FROM livres l
        INNER JOIN auteurs a ON a.id = l.auteur_id
        WHERE a.nom LIKE ?
        ORDER BY l.annee DESC';
$req = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($req, 's', $motif);
mysqli_stmt_execute($req);
$res = mysqli_stmt_get_result($req);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E12 - Livres par auteur</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
    </style>
</head>
<body>

<h1>Rechercher un auteur</h1>

<form method="get">
    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="nom de l'auteur">
    <input type="submit" value="Chercher">
</form>

<?php if (mysqli_num_rows($res) === 0): ?>
    <p>Aucun livre trouvé</p>
<?php else: ?>
    <ul>
        <?php while ($l = mysqli_fetch_assoc($res)): ?>
            <li><?= htmlspecialchars($l['titre']) ?> (<?= (int) $l['annee'] ?>) : <?= htmlspecialchars($l['auteur']) ?></li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>

</body>
</html>