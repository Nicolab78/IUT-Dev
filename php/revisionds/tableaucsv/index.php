<?php
$prixMax = isset($_POST['prix_max']) && $_POST['prix_max'] !== ''
    ? (float) $_POST['prix_max']
    : null;

$produits = [];
$fichier = fopen('produits.csv', 'r');

fgetcsv($fichier, 0, ',', '"', '');

while (($ligne = fgetcsv($fichier, 0, ',', '"', '')) !== false) {
    $produits[] = [
        'nom'   => $ligne[0],
        'prix'  => (float) $ligne[1],
        'stock' => (int) $ligne[2],
    ];
}
fclose($fichier);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="post">
    <label for="prix_max">Prix minimum</label>
    <input type="number" step="0.01" id="prix_max" name="prix_max"
           value="<?= htmlspecialchars($prixMax) ?>)?>">
    <input type="submit" value="Filtrer">
</form>

<table>
    <tr><th>Nom</th><th>Prix</th><th>Stock</th></tr>
    <?php foreach ($produits as $p): ?>
        <?php if ($prixMax === null || $p['prix'] <= $prixMax): ?>
            <tr class="<?= $p['stock'] === 0 ? 'rupture' : ''?>">
                <td><?= htmlspecialchars($p['nom']) ?></td>
                <td><?= number_format($p['prix'], 2, ',',' ')?></td>
                <td><?= $p['stock']?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>


</body>
</html>
