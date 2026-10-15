<?php
$notes = [12, 8, 15, 10, 17, 6, 14];

function moyenne(array $t): float {
    return array_sum($t) / count($t);
}

function mediane(array $t): float {
    sort($t);
    $n = count($t);
    $m = intdiv($n, 2);
    return $n % 2 === 1 ? $t[$m] : ($t[$m - 1] + $t[$m]) / 2;
}

$moy = moyenne($notes);
$audessus = array_filter($notes, fn($n) => $n > $moy);
$decroissant = $notes;
rsort($decroissant);

echo "<p>Moyenne : " . round($moy, 2) . "</p>";
echo "<p>Médiane : " . mediane($notes) . "</p>";
echo "<p>Min : " . min($notes) . " / Max : " . max($notes) . "</p>";
echo "<p>Au-dessus de la moyenne : " . count($audessus) . " (" . implode(', ', $audessus) . ")</p>";
echo "<p>Classement : " . implode(' > ', $decroissant) . "</p>";