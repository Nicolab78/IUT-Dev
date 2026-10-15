<?php
require __DIR__ . '/db.php';
$connexion = connecter();

$cats = [];
$res = mysqli_query($connexion, 'SELECT DISTINCT categorie FROM produits ORDER BY categorie');
while ($ligne = mysqli_fetch_assoc($res)) {
    $cats[] = $ligne['categorie'];
}

$choix = $_GET['categorie'] ?? 'Toutes';
if ($choix !== 'Toutes' && !in_array($choix, $cats, true)) {
    $choix = 'Toutes';
}

if ($choix === 'Toutes') {
    $res = mysqli_query($connexion, 'SELECT nom, categorie, prix, stock FROM produits ORDER BY nom');
} else {
    $req = mysqli_prepare($connexion,
        'SELECT nom, categorie, prix, stock FROM produits WHERE categorie = ? ORDER BY nom');
    mysqli_stmt_bind_param($req, 's', $choix);
    mysqli_stmt_execute($req);
    $res = mysqli_stmt_get_result($req);
}
$nb = mysqli_num_rows($res);
$total = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E10 - Produits par catégorie</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; margin: 1rem 0; }
        th, td { border: 0.0625rem solid gray; padding: 0.3rem 0.8rem; }
    </style>
</head>
<body>

<h1>Produits</h1>

<form method="get">
    <select name="categorie">
        <option>Toutes</option>
        <?php foreach ($cats as $c): ?>
            <option <?= $c === $choix ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Filtrer">
</form>

<p><?= $nb ?> produit(s)</p>

<table>
    <tr><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Stock</th></tr>
    <?php while ($p = mysqli_fetch_assoc($res)): ?>
        <?php $total += $p['prix'] * $p['stock']; ?>
        <tr>
            <td><?= htmlspecialchars($p['nom']) ?></td>
            <td><?= htmlspecialchars($p['categorie']) ?></td>
            <td><?= number_format($p['prix'], 2, ',', ' ') ?> €</td>
            <td><?= (int) $p['stock'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<p>Valeur du stock : <?= number_format($total, 2, ',', ' ') ?> €</p>

</body>
</html>