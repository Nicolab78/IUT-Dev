<?php
function moyenne(array $x, array $n): float {

    return array_sum(array_map(fn($a, $b) => $a * $b, $x, $n)) / array_sum($n);
}

function variance(array $x, array $n): float {

    return moyenne(array_map(fn($a) => $a * $a, $x), $n) - moyenne($x, $n) ** 2;
}

function ecarttype(array $x, array $n): float {
    return sqrt(variance($x, $n));
}