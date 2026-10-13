<?php

$visites = isset($_COOKIE['visites']) ? (int) $_COOKIE['visites'] + 1 : 1;
setcookie('visites', $visites, time() + 3600);

if (isset($_GET['theme']) && in_array($_GET['theme'], ['clair', 'sombre'], true)) {
    setcookie('theme', $_GET['theme'], time() + 30 * 24 * 3600);
    $theme = $_GET['theme'];
} else {
    $theme = $_COOKIE['theme'] ?? 'clair';
}

$fond  = $theme === 'sombre' ? 'black' : 'white';
$texte = $theme === 'sombre' ? 'white' : 'black';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page 0</title>
    <style>
        body { background-color: <?= $fond ?>; color: <?= $texte ?>; font-family: sans-serif; }
        a { color: dodgerblue; }
    </style>
</head>
<body>
<h1>Page 0</h1>
<p>Nombre de visites : <strong><?= $visites ?></strong></p>
<p>
    <a href="?theme=clair">Mode clair</a> |
    <a href="?theme=sombre">Mode sombre</a>
</p>
<p><a href="page1.php">Page 1</a> | <a href="page2.php">Page 2</a></p>
</body>
</html>