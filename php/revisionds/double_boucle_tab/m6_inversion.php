<?php
$n = 4;

function afficher(string $titre, bool $inverseLignes, bool $inverseColonnes, int $n): void {
    echo "<h3>$titre</h3><table>";
    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $n; $j++) {
            $l = $inverseLignes   ? $n + 1 - $i : $i;
            $c = $inverseColonnes ? $n + 1 - $j : $j;
            echo "<td>" . (($l - 1) * $n + $c) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>6 - Inversion</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; display: inline-table; margin-right: 2rem; }
        td { width: 2.5rem; height: 2.5rem; border: 0.0625rem solid gray; text-align: center; }
        h3 { font-size: 1rem; }
    </style>
</head>
<body>

<?php
afficher('Normal', false, false, $n);
afficher('Lignes inversées (miroir)', true, false, $n);
afficher('Lignes et colonnes inversées (rotation 180°)', true, true, $n);
?>

</body>
</html>