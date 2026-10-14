<?php

$eleves = [];
$f = fopen("liste_eleve.csv", "r");
$entetes = fgetcsv($f);
while (($ligne = fgetcsv($f)) !== false) {
    $eleves[] = array_combine($entetes, $ligne);
}
fclose($f);

$filiere = $_POST['filiere'] ?? 'Toutes';
if($filiere !== 'Toutes'){
    $eleves = array_filter($eleves, fn($e) => $e['filiere'] === $filiere);
}

$sommes = [];
$effectifs = [];
foreach ($eleves as $e) {
    $moy = ($e['note_php'] + $e['note_sql']) / 2;
    $sommes[$e['filiere']] = ($sommes[$e['filiere']] ?? 0) + $moy;
    $effectifs[$e['filiere']] = ($effectifs[$e['filiere']] ?? 0) + 1;
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste Élèves</title>
    <style>
        table {
            border-collapse: collapse;
            th, td {
                border: 0.0625rem solid gray;
                padding: 0.4rem 0.8rem;

            }
            .faible {
                color: crimson;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<form method="post">
    <select name="filiere">
        <?php foreach (['Toutes', 'Informatique', 'Réseaux'] as $option): ?>
        <option value="<?= $option ?>" <?= $filiere === $option ? 'selected' : '' ?>><?= $option ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Filtrer">

</form>

<table>
    <tr><th>Nom</th><th>Prénom</th><th>Filière</th><th>PHP</th><th>SQL</th><th>Moyenne</th></tr>
    <?php foreach ($eleves as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['nom']) ?></td>
            <td><?= htmlspecialchars($e['prenom'])?></td>
            <td><?= htmlspecialchars($e['filiere'])?></td>
            <td class="<?= $e['note_php'] < 10 ? 'faible' : '' ?>"><?= $e['note_php'] ?></td>
            <td class="<?= $e['note_sql'] < 10 ? 'faible' : '' ?>"><?= $e['note_sql'] ?></td>
            <td><?= round(($e['note_php'] + $e['note_sql']) / 2, 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Moyenne par filière</h3>
<ul>
    <?php foreach ($sommes as $nom => $somme): ?>
        <li><?= htmlspecialchars($nom) ?> : <?= round($somme / $effectifs[$nom], 2) ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
