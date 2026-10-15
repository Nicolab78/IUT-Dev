<?php
require __DIR__ . '/db.php';
$connexion = connecter();

function chargerPlanning(mysqli $connexion): array {
    $planning = [];
    $res = mysqli_query($connexion, 'SELECT jour, heure, matiere FROM cours');
    while ($ligne = mysqli_fetch_assoc($res)) {
        $planning[$ligne['jour'] . ',' . $ligne['heure']] = $ligne['matiere'];
    }
    return $planning;
}

$jours  = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
$heures = [8, 10, 14];
$planning = chargerPlanning($connexion);                  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>7 - Planning depuis MySQL</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; }
        th, td { border: 0.0625rem solid gray; padding: 0.5rem 1rem; text-align: center; }
        td.cours { background-color: lightsteelblue; }
    </style>
</head>
<body>

<table>
    <tr>
        <th></th>
        <?php foreach ($jours as $jour): ?>
            <th><?= $jour ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($heures as $heure): ?>
        <tr>
            <th><?= $heure ?>h</th>
            <?php foreach ($jours as $jour): ?>
                <?php $matiere = $planning["$jour,$heure"] ?? ''; ?>
                <td class="<?= $matiere !== '' ? 'cours' : '' ?>"><?= htmlspecialchars($matiere) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>