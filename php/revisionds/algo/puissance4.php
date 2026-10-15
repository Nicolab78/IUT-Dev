<?php
session_start();

const LIGNES = 6;
const COLONNES = 7;

function aGagne(array $g, string $c): bool {
    $directions = [[0, 1], [1, 0], [1, 1], [1, -1]];
    for ($i = 0; $i < LIGNES; $i++) {
        for ($j = 0; $j < COLONNES; $j++) {
            foreach ($directions as [$di, $dj]) {
                $nb = 0;
                for ($k = 0; $k < 4; $k++) {
                    $x = $i + $k * $di;
                    $y = $j + $k * $dj;
                    if ($x < 0 || $x >= LIGNES || $y < 0 || $y >= COLONNES || $g[$x][$y] !== $c) {
                        break;
                    }
                    $nb++;
                }
                if ($nb === 4) {
                    return true;
                }
            }
        }
    }
    return false;
}

if (!isset($_SESSION['grille'])) {
    $_SESSION['grille'] = array_fill(0, LIGNES, array_fill(0, COLONNES, ''));
    $_SESSION['joueur'] = 'R';          // R = rouge, J = jaune
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rejouer'])) {
        unset($_SESSION['grille'], $_SESSION['joueur']);
    } elseif (isset($_POST['colonne']) && !aGagne($_SESSION['grille'], 'R') && !aGagne($_SESSION['grille'], 'J')) {
        $col = (int) $_POST['colonne'];
        if ($col >= 0 && $col < COLONNES) {
            for ($i = LIGNES - 1; $i >= 0; $i--) {          // on cherche la case libre la plus basse
                if ($_SESSION['grille'][$i][$col] === '') {
                    $_SESSION['grille'][$i][$col] = $_SESSION['joueur'];
                    $_SESSION['joueur'] = $_SESSION['joueur'] === 'R' ? 'J' : 'R';
                    break;
                }
            }
        }
    }
    header('Location: puissance4.php');
    exit;
}

$grille = $_SESSION['grille'];
$couleurs = ['' => 'white', 'R' => 'red', 'J' => 'gold'];
$noms = ['R' => 'Rouge', 'J' => 'Jaune'];
$gagnant = aGagne($grille, 'R') ? 'R' : (aGagne($grille, 'J') ? 'J' : '');
$plein = !in_array('', $grille[0], true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Puissance 4</title>
    <style>
        table { border-collapse: collapse; background-color: royalblue; }
        td { width: 3.5rem; height: 3.5rem; text-align: center; }
        .jeton { display: inline-block; width: 2.8rem; height: 2.8rem; border-radius: 50%; }
    </style>
</head>
<body>
<h1>Puissance 4</h1>

<?php if ($gagnant !== ''): ?>
    <p><strong><?= $noms[$gagnant] ?> a gagné !</strong></p>
<?php elseif ($plein): ?>
    <p><strong>Match nul</strong></p>
<?php else: ?>
    <p>Au tour de : <?= $noms[$_SESSION['joueur']] ?></p>
<?php endif; ?>

<form method="post">
    <table>
        <?php if ($gagnant === '' && !$plein): ?>
            <tr>
                <?php for ($j = 0; $j < COLONNES; $j++): ?>
                    <td><button type="submit" name="colonne" value="<?= $j ?>">&#9660;</button></td>
                <?php endfor; ?>
            </tr>
        <?php endif; ?>
        <?php for ($i = 0; $i < LIGNES; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < COLONNES; $j++): ?>
                    <td><span class="jeton" style="background-color: <?= $couleurs[$grille[$i][$j]] ?>"></span></td>
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