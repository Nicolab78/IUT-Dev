<?php

function display($a) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

function moyenne($x, $n) {
    return array_sum(array_map(fn($a, $b) => $a * $b, $x, $n)) / array_sum($n);
}

function variance($x, $n){
    return moyenne(array_map(fn($a) => $a * $a, $x), $n) - moyenne($x,$n) ** 2;
}

function ecarttype($x, $n) {
    return sqrt(variance($x, $n));
}



?>