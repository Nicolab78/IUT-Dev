<?php
$a  = $_POST['a']  ?? '';
$b  = $_POST['b']  ?? '';
$op = $_POST['op'] ?? '+';
$erreur = '';
$resultat = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_numeric($a) || !is_numeric($b)) {
        $erreur = 'Entrez deux nombres';
    } elseif (!in_array($op, ['+', '-', '*', '/'], true)) {
        $erreur = 'Opération inconnue';
    } else {
        switch ($op) {
            case '+': $resultat = $a + $b; break;
            case '-': $resultat = $a - $b; break;
            case '*': $resultat = $a * $b; break;
            case '/':
                if ((float) $b == 0) {
                    $erreur = 'Division par zéro impossible';
                } else {
                    $resultat = $a / $b;
                }
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E3 - Calculatrice</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        .erreur { color: firebrick; }
        .resultat { color: seagreen; font-weight: bold; }
    </style>
</head>
<body>

<h1>Calculatrice</h1>

<form method="post">
    <input type="text" name="a" value="<?= htmlspecialchars($a) ?>" size="6">
    <select name="op">
        <?php foreach (['+', '-', '*', '/'] as $o): ?>
            <option value="<?= $o ?>" <?= $o === $op ? 'selected' : '' ?>><?= $o ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="b" value="<?= htmlspecialchars($b) ?>" size="6">
    <input type="submit" value="=">
</form>

<?php if ($erreur !== ''): ?>
    <p class="erreur"><?= $erreur ?></p>
<?php elseif ($resultat !== null): ?>
    <p class="resultat">Résultat : <?= $resultat ?></p>
<?php endif; ?>

</body>
</html>