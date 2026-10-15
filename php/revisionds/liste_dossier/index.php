<?php
$dossier = 'data';
$lignes = [];
foreach (scandir($dossier) as $nom) {
    if (!is_file("$dossier/$nom")) {
        continue;
    }
    $lignes[] = ['nom' => $nom, 'taille' => filesize("$dossier/$nom")];
}
usort($lignes, fn($a, $b) => $b['taille'] <=> $a['taille']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E9 - Fichiers du dossier</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; }
        th, td { border: 0.0625rem solid gray; padding: 0.3rem 0.8rem; }
    </style>
</head>
<body>

<h1>Contenu du dossier « <?= htmlspecialchars($dossier) ?> »</h1>

<table>
    <tr><th>Nom</th><th>Taille (octets)</th></tr>
    <?php foreach ($lignes as $l): ?>
        <tr>
            <td><?= htmlspecialchars($l['nom']) ?></td>
            <td><?= $l['taille'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>