<?php
require 'function.php';

$notes = [8, 10, 12, 14, 16];
$effectif = [2, 5, 8, 4, 1];

$choix = $_POST['stats'] ?? '';
$valeur = '';

switch ($choix) {
    case 'moyenne': $valeur = round(moyenne($notes,$effectif), 2); break;
    case 'variance': $valeur = round(variance($notes,$effectif),2); break;
    case 'ecarttype': $valeur = round(ecarttype($notes,$effectif),2); break;
}
 ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistiques</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<table>
    <tr><th>Notes</th>  <th>Effectif</th></tr>
    <?php foreach ($notes as $i => $note): ?>
        <tr>
            <td><?= $note ?></td>
            <td><?= $effectif[$i]?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form method="POST">
    <select name="stats">
        <option value="moyenne" <?= $choix === 'moyenne' ? 'selected' : ''?> >Moyenne</option>
        <option value="variance" <?= $choix === 'variance' ? 'selected' : ''?>>Variance</option>
        <option value="ecarttype" <?= $choix === 'ecarttype' ? 'selected' : ''?>>Écart type</option>
    </select>
    <input type="submit" value="Calculer">

</form>

<?php if ($valeur !== ''): ?>
    <p>Résultat : <strong><?= $valeur ?></strong></p>

<?php endif; ?>
</body>
</html>
