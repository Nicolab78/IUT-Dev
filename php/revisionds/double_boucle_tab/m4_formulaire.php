<?php
$taille = 4;
$couleur = '#8fbc8f';
$inverser = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taille   = (int) $_POST['taille'];
    $couleur  = $_POST['couleur'];
    $inverser = isset($_POST['inverser']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>4 - Formulaire</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { margin-bottom: 1rem; }
        table { border-collapse: collapse; }
        td { width: 2.5rem; height: 2.5rem; border: 0.0625rem solid gray; text-align: center; }
    </style>
</head>
<body>

<form method="post">
    <label for="taille">Taille</label>
    <input type="number" id="taille" name="taille" min="2" max="20" value="<?= $taille ?>">

    <label for="couleur">Couleur</label>
    <input type="color" id="couleur" name="couleur" value="<?= $couleur ?>">

    <label for="inverser">Inverser</label>
    <input type="checkbox" id="inverser" name="inverser" <?= $inverser ? 'checked' : '' ?>>

    <input type="submit" value="Afficher">
</form>

<table>
    <?php for ($i = 1; $i <= $taille; $i++): ?>
        <tr>
            <?php for ($j = 1; $j <= $taille; $j++): ?>
                <?php
                $l = $inverser ? $taille + 1 - $i : $i;
                $c = $inverser ? $taille + 1 - $j : $j;
                ?>
                <td style="background-color: <?= ($l + $c) % 2 === 0 ? $couleur : 'white' ?>;"><?= ($l - 1) * $taille + $c ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

</body>
</html>