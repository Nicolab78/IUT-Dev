<?php
require 'db.php';
require 'auth.php';
$connexion = connecter();

$erreur = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $mdp   = $_POST['password'] ?? '';

    $req = mysqli_prepare($connexion, 'SELECT login, password, role FROM users WHERE login = ?');
    mysqli_stmt_bind_param($req, 's', $login);
    mysqli_stmt_execute($req);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($req));

    if ($user && password_verify($mdp, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['login'] = $user['login'];
        $_SESSION['role']  = $user['role'];
        header('Location: liste.php');
        exit;
    }
    $erreur = 'Identifiants incorrects';
}

require 'header.php';
?>
    <h1>Connexion</h1>
<?php if ($erreur !== ''): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

    <form method="post">
        <label>Login <input type="text" name="login"></label><br>
        <label>Mot de passe <input type="password" name="password"></label><br>
        <button type="submit">Se connecter</button>
    </form>
<?php require 'footer.php'; ?>