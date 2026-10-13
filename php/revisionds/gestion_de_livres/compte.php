<?php
require 'db.php';
$connexion = connecter();

$req = mysqli_prepare($connexion, 'INSERT INTO users (login, password, role) VALUES (?, ?, ?)');

foreach ([['admin', 'admin123', 'admin'], ['alice', 'azerty123', 'user']] as [$l, $m, $r]) {
    $hash = password_hash($m, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($req, 'sss', $l, $hash, $r);
    mysqli_stmt_execute($req);
}
echo 'Comptes créés';