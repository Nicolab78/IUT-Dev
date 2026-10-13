<?php

$visites = isset($_GET['visites']) ? (int) $_COOKIE['visites'] + 1 : 1;
setcookie('visites', $visites, time() + 3600);

if (isset($_GET['theme']) && in_array($_GET['theme'], ['clair', 'sombre'], true)) {
    setcookie('theme', $_GET['theme'], time() + 30 * 24 * 3600);
    $theme = $_GET['theme'];
} else {
    $theme = $_COOKIE['theme'] ?? 'clair';
}

$fond = $theme === 'sombre' ? 'black' : 'white';
$texte = $theme === 'sombre' ? 'white' : 'black';

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page 2</title>
    <style>
        body {
            background: <?= $fond?>;
            color: <?= $texte?>;
            font-family: sans-serif;
        }
        a {
            color: dodgerblue;
        }
    </style>
</head>
<body>
<h1>Page 1</h1>
<p>Nombre de visites : <stron><?= $visites ?></stron></p>
<p><a href="page0.php">Page 0 </a> | <a href="page1.php">Page 1</a></p>

</body>
</html>
