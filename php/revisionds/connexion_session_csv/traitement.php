<?php
session_start();

function verifUser(string $login, string $password): bool {
    $fichier = fopen('users.csv', 'r');
    fgetcsv($fichier);
    while (($ligne = fgetcsv($fichier)) !== false) {
        if ($ligne[0] === $login) {
            fclose($fichier);
            return password_verify($password, $ligne[1]);
        }
    }
    fclose($fichier);
    return false;
}

if (isset($_POST['login'], $_POST['password'])
    && verifUser($_POST['login'], $_POST['password'])) {
    $_SESSION['login'] = $_POST['login'];
    header('Location: profil.php');
    exit;
}

header('Location: login.php?error=1');
exit;