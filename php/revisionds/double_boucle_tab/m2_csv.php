<?php
$eleves = [];
$f = fopen('notes.csv', 'r');
fgetcsv($f, null, ',', '"', '\\');
while (($ligne = fgetcsv($f, null, ',', '"', '\\')) !== false) {
    if (count($ligne) < 2) {
        continue;
    }
    $eleves[] = ['nom' => $ligne[0], 'note' => (float) $ligne[1]];
}
fclose($f);

usort($eleves, fn($a, $b) => $b['note'] <=> $a['note']);
$moyenne = array_sum(array_column($eleves, 'note')) / count($eleves);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>2 - CSV en tableau</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; }
        th, td { border: 0.0625rem solid gray; padding: 0.3rem 0.8rem; }
    </style>
</head>
<body>

<table>
    <tr><th>Nom</th><th>Note</th></tr>
    <?php foreach ($eleves as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['nom']) ?></td>
            <td><?= $e['note'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p>Moyenne : <?= round($moyenne, 2) ?></p>

</body>
</html>