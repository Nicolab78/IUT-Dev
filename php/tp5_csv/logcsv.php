<?php
session_start();

function verifUser(string $login, string $password): bool {
    $fichier = fopen('users.csv', 'r');
    fgetcsv($fichier, null, ',', '"', '\\');
    while (($ligne = fgetcsv($fichier, null, ',', '"', '\\')) !== false) {
        if (count($ligne) < 2) {
            continue;
        }
        if ($ligne[0] === $login) {
            fclose($fichier);
            return $ligne[1] === md5($password);
        }
    }
    fclose($fichier);
    return false;
}

if (isset($_POST['login'], $_POST['password'])) {
    if (verifUser($_POST['login'], $_POST['password'])) {
        $_SESSION['login'] = $_POST['login'];
        header('Location: admin.php');
        exit;
    }
}

header('Location: login.php?error=1');
exit;