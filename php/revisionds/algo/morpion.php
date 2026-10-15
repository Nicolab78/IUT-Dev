<?php
session_start();

function vainqueur(array $g): string {
    $lignes = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8],      // lignes
        [0, 3, 6], [1, 4, 7], [2, 5, 8],      // colonnes
        [0, 4, 8], [2, 4, 6],                 // diagonales
    ];
    foreach ($lignes as $l) {
        if ($g[$l[0]] !== '' && $g[$l[0]] === $g[$l[1]] && $g[$l[1]] === $g[$l[2]]) {
            return $g[$l[0]];
        }
    }
    return '';
}

if (!isset($_SESSION['grille'])) {
    $_SESSION['grille'] = array_fill(0, 9, '');
    $_SESSION['joueur'] = 'X';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rejouer'])) {
        unset($_SESSION['grille'], $_SESSION['joueur']);
    } elseif (isset($_POST['case']) && vainqueur($_SESSION['grille']) === '') {
        $case = (int) $_POST['case'];
        if ($case >= 0 && $case <= 8 && $_SESSION['grille'][$case] === '') {
            $_SESSION['grille'][$case] = $_SESSION['joueur'];
            $_SESSION['joueur'] = $_SESSION['joueur'] === 'X' ? 'O' : 'X';
        }
    }
    header('Location: morpion.php');
    exit;
}

$grille = $_SESSION['grille'];
$gagnant = vainqueur($grille);
$plein = !in_array('', $grille, true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Morpion</title>
    <style>
        table { border-collapse: collapse; }
        td { border: 0.1rem solid black; width: 4rem; height: 4rem; text-align: center; font-size: 2rem; }
        td button { width: 100%; height: 100%; font-size: 2rem; background-color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
<h1>Morpion</h1>

<?php if ($gagnant !== ''): ?>
    <p><strong>Le joueur <?= $gagnant ?> a gagné !</strong></p>
<?php elseif ($plein): ?>
    <p><strong>Match nul</strong></p>
<?php else: ?>
    <p>Au tour de <?= $_SESSION['joueur'] ?></p>
<?php endif; ?>

<form method="post">
    <table>
        <?php for ($i = 0; $i < 3; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++): ?>
                    <?php $n = $i * 3 + $j; ?>
                    <td>
                        <?php if ($grille[$n] !== ''): ?>
                            <?= $grille[$n] ?>
                        <?php elseif ($gagnant === ''): ?>
                            <button type="submit" name="case" value="<?= $n ?>">&nbsp;</button>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</form>

<form method="post">
    <input type="submit" name="rejouer" value="Nouvelle partie">
</form>
</body>
</html>