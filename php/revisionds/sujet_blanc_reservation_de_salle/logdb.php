<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "rootroot", "campus");

if (!isset($_POST['login'], $_POST['password'])) {
    header('Location: login.php');
    exit;
}
$login = trim($_POST['login']);
$password = $_POST['password'];

$req = mysqli_prepare($connexion, "SELECT login, password FROM users WHERE login = ?");
mysqli_stmt_bind_param($req, 's', $login);
mysqli_stmt_execute($req);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($req));
mysqli_close($connexion);

if ($user && hash_equals($user['password'], md5($password))) {
    $_SESSION['login'] = $user['login'];
    header('Location: liste.php');
    exit;
}
header('Location: login.php?error=1');
exit;