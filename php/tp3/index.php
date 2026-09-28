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
            width: 2rem;
            height: 2rem;
            border: 0.0625rem solid gray;
            text-align: center;
            font-size: 1.3rem;
        }
    </style>
</head>
<body>

<form action="" method="post">
    <label for="Colonne">Colonne</label>
    <input type="number" id="Colonne" name="Colonne" step="1" min="1" max="20">
    <br>
    <label for="Ligne">Ligne</label>
    <input type="number" id="Ligne" name="Ligne" step="1" min="1" max="20">
    <br>
    <label for="Couleur">Couleur</label>
    <input type="color" name="Couleur" id="Couleur">
    <br>
    <input type="submit" value="Mettre a jour le damier">
</form>

<?php

function chargerPieces($chemin) {
    $pieces = [];
    $handle = fopen($chemin, 'r');
    fgetcsv($handle);
    while (($ligne = fgetcsv($handle)) !== false) {
        $cle = $ligne[3] . ',' . $ligne[4];
        $pieces[$cle] = $ligne[2];
    }
    fclose($handle);
    return $pieces;
}

$pieces = chargerPieces('damier.csv');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nbLignes = (int)$_POST['Ligne'];
    $nbColonnes = (int)$_POST['Colonne'];
    $couleur = $_POST['Couleur'];

    echo "<table>";
    for ($i = 1; $i <= $nbLignes; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $nbColonnes; $j++) {
            $fond = (($i + $j) % 2 == 0) ? $couleur : 'white';
            $cle = "$i,$j";
            $contenu = isset($pieces[$cle]) ? $pieces[$cle] : '';
            echo "<td style='background-color:" . $fond . ";'>" . $contenu . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

</body>
</html>