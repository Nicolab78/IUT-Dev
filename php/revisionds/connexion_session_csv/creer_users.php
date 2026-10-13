<?php
$utilisateurs = ['admin' => 'admin123', 'alice' => 'azerty123'];

$f = fopen('users.csv', 'w');
fputcsv($f, ['login', 'hash']);
foreach ($utilisateurs as $login => $mdp) {
    fputcsv($f, [$login, password_hash($mdp, PASSWORD_DEFAULT)]);
}
fclose($f);
echo 'users.csv créé';