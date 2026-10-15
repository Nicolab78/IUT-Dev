<?php
$dossier = 'data';

$fichiers = [];
foreach (scandir($dossier) as $nom) {
    if (pathinfo($nom, PATHINFO_EXTENSION) === 'csv') {
        $fichiers[] = $nom;
    }
}

$choix = $_POST['fichier'] ?? $fichiers[0];
if (!in_array($choix, $fichiers, true)) {
    $choix = $fichiers[0];
}

$lignes = [];
$f = fopen("$dossier/$choix", 'r');
while (($ligne = fgetcsv($f, null, ',', '"', '\\')) !== false) {
    if (count($ligne) > 1) {
        $lignes[] = $ligne;
    }
}
fclose($f);
$entete = array_shift($lignes);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>5 - scandir</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { margin-bottom: 1rem; }
        table { border-collapse: collapse; }
        th, td { border: 0.0625rem solid gray; padding: 0.3rem 0.8rem; }
    </style>
</head>
<body>

<form method="post">
    <select name="fichier">
        <?php foreach ($fichiers as $nom): ?>
            <option value="<?= htmlspecialchars($nom) ?>" <?= $nom === $choix ? 'selected' : '' ?>><?= htmlspecialchars($nom) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Afficher">
</form>

<table>
    <tr>
        <?php foreach ($entete as $titre): ?>
            <th><?= htmlspecialchars($titre) ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($lignes as $ligne): ?>
        <tr>
            <?php foreach ($ligne as $valeur): ?>
                <td><?= htmlspecialchars($valeur) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>