<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Damier</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
        }

        form {
            margin-bottom: 1rem;
        }

        table {
            border-collapse: collapse;
        }

        td {
            width: 2.5rem;
            height: 2.5rem;
            border: 0.0625rem solid gray;
            text-align: center;
            font-size: 1.6rem;
        }
    </style>
</head>
<body>

<?php

function chargerPieces($chemin) {
    $pieces = [];
    $gererPiece = fopen($chemin, 'r');
    fgetcsv($gererPiece, null, ',', '"', '\\');
    while (($ligne = fgetcsv($gererPiece, null, ',', '"', '\\')) !== false) {
        if (count($ligne) < 5) {
            continue;
        }
        $pieces[$ligne[3] . ',' . $ligne[4]] = $ligne[2];
    }
    fclose($gererPiece);
    return $pieces;
}

$nbLignes = (int)($_POST['Ligne'] ?? 8);
$nbColonnes = (int)($_POST['Colonne'] ?? 8);
$couleur = $_POST['Couleur'] ?? '#8fbc8f';
$inverser = isset($_POST['Inverser']);
?>

<form action="" method="post">
    <label for="Colonne">Colonne</label>
    <input type="number" id="Colonne" name="Colonne" step="1" min="1" max="20" value="<?= $nbColonnes ?>">
    <br>
    <label for="Ligne">Ligne</label>
    <input type="number" id="Ligne" name="Ligne" step="1" min="1" max="20" value="<?= $nbLignes ?>">
    <br>
    <label for="Couleur">Couleur</label>
    <input type="color" name="Couleur" id="Couleur" value="<?= $couleur ?>">
    <br>
    <label for="Inverser">Inverser les pieces (haut/bas)</label>
    <input type="checkbox" name="Inverser" id="Inverser" <?= $inverser ? 'checked' : '' ?>>
    <br>
    <input type="submit" value="Mettre a jour le damier">
</form>

<?php
$pieces = chargerPieces('damier.csv');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nbLignes   = (int)$_POST['Ligne'];
    $nbColonnes = (int)$_POST['Colonne'];
    $couleur    = $_POST['Couleur'];
    $inverser   = isset($_POST['Inverser']);

    echo "<table>";
    for ($i = 1; $i <= $nbLignes; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $nbColonnes; $j++) {
            $ligneCsv   = $inverser ? $nbLignes + 1 - $i : $i;
            $colonneCsv = $inverser ? $nbColonnes + 1 - $j : $j;

            $fond = (($ligneCsv + $colonneCsv) % 2 == 0) ? $couleur : 'white';

            $contenu = $pieces["$ligneCsv,$colonneCsv"] ?? '';
            echo "<td style='background-color:" . $fond . ";'>" . $contenu . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

</body>
</html>