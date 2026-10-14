<?php
session_start();

function verifUserdb(string $login) {
    $connexion = mysqli_connect("127.0.0.1", "root", "rootroot", "studentsphp");

    $sql = "SELECT login, password FROM users WHERE login = ?";
    $req = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($req, "s", $login);
    mysqli_stmt_execute($req);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($req));

    mysqli_close($connexion);

    return $row;
}

if (isset($_POST['login'], $_POST['password'])) {
    $row = verifUserdb($_POST['login']);

    if ($row && $row['password'] === md5($_POST['password'])) {
        $_SESSION['login'] = $row['login'];
        header('Location: admin.php');
        exit;
    }
}

header('Location: login.php?error=1');
exit;