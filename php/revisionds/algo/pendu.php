<?php
session_start();

const MAX_ERREURS = 7;

function chargerMots(string $chemin): array {
    $mots = [];
    $fichier = fopen($chemin, 'r');
    fgetcsv($fichier, null, ',', '"', '\\');
    while (($ligne = fgetcsv($fichier, null, ',', '"', '\\')) !== false) {
        if ($ligne[0] !== null && trim($ligne[0]) !== '') {
            $mots[] = strtolower(trim($ligne[0]));
        }
    }
    fclose($fichier);
    return $mots;
}

function motAffiche(string $mot, array $lettres): string {
    $affichage = '';
    foreach (str_split($mot) as $lettre) {
        $affichage .= in_array($lettre, $lettres, true) ? $lettre . ' ' : '_ ';
    }
    return $affichage;
}

if (!isset($_SESSION['mot'])) {
    $mots = chargerMots(__DIR__ . '/data/mots.csv');
    $_SESSION['mot'] = $mots[array_rand($mots)];
    $_SESSION['lettres'] = [];
    $_SESSION['erreurs'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rejouer'])) {
        session_unset();
        header('Location: pendu.php');
        exit;
    }
    $lettre = strtolower($_POST['lettre'] ?? '');
    if (strlen($lettre) === 1 && ctype_alpha($lettre) && !in_array($lettre, $_SESSION['lettres'], true)) {
        $_SESSION['lettres'][] = $lettre;
        if (strpos($_SESSION['mot'], $lettre) === false) {
            $_SESSION['erreurs']++;
        }
    }
}

$mot = $_SESSION['mot'];
$gagne = true;
foreach (str_split($mot) as $l) {
    if (!in_array($l, $_SESSION['lettres'], true)) {
        $gagne = false;
    }
}
$perdu = $_SESSION['erreurs'] >= MAX_ERREURS;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Pendu</title>
    <style>
        .mot { font-size: 2rem; letter-spacing: 0.3rem; font-family: monospace; }
        button { width: 2.2rem; height: 2.2rem; margin: 0.1rem; }
    </style>
</head>
<body>
<h1>Pendu</h1>
<p class="mot"><?= motAffiche($mot, $_SESSION['lettres']) ?></p>
<p>Erreurs : <?= $_SESSION['erreurs'] ?> / <?= MAX_ERREURS ?></p>

<?php if ($gagne): ?>
    <p><strong>Gagné ! Le mot était « <?= htmlspecialchars($mot) ?> »</strong></p>
<?php elseif ($perdu): ?>
    <p><strong>Perdu ! Le mot était « <?= htmlspecialchars($mot) ?> »</strong></p>
<?php else: ?>
    <form method="post">
        <?php foreach (range('a', 'z') as $l): ?>
            <button type="submit" name="lettre" value="<?= $l ?>" <?= in_array($l, $_SESSION['lettres'], true) ? 'disabled' : '' ?>><?= $l ?></button>
        <?php endforeach; ?>
    </form>
<?php endif; ?>

<form method="post">
    <input type="submit" name="rejouer" value="Rejouer">
</form>
</body>
</html>