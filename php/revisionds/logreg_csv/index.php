<?php
function verifUser(string $login, string $password): bool {
    $f = fopen('users.csv', 'r');
    fgetcsv($f, null, ',', '"', '\\');                         // en-tête
    while (($ligne = fgetcsv($f, null, ',', '"', '\\')) !== false) {
        if (count($ligne) >= 2 && $ligne[0] === $login) {
            fclose($f);
            return hash_equals($ligne[1], md5($password));
        }
    }
    fclose($f);
    return false;
}

function ajouterUser(string $login, string $password): bool {
    $f = fopen('users.csv', 'r');
    fgetcsv($f, null, ',', '"', '\\');
    while (($ligne = fgetcsv($f, null, ',', '"', '\\')) !== false) {
        if (count($ligne) >= 2 && $ligne[0] === $login) {
            fclose($f);
            return false;
        }
    }
    fclose($f);

    $contenu = file_get_contents('users.csv');
    $f = fopen('users.csv', 'a');
    if ($contenu !== '' && substr($contenu, -1) !== "\n") {
        fwrite($f, "\n");
    }
    fputcsv($f, [$login, md5($password)], ',', '"', '\\');
    fclose($f);
    return true;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($_POST['action'] === 'connexion') {
        $message = verifUser($login, $password) ? "Connexion réussie : $login" : 'Login ou mot de passe incorrect';
    } elseif ($_POST['action'] === 'inscription') {
        $message = ajouterUser($login, $password) ? "Utilisateur $login ajouté" : 'Ce login existe déjà';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E5 - Utilisateurs CSV</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { display: inline-block; vertical-align: top; margin-right: 1rem; padding: 1rem; background-color: whitesmoke; }
        label, input { display: block; margin-bottom: 0.5rem; }
        .message { font-weight: bold; color: steelblue; }
    </style>
</head>
<body>

<h1>Utilisateurs dans un fichier CSV</h1>

<?php if ($message !== ''): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <h2>Connexion</h2>
    <input type="hidden" name="action" value="connexion">
    <label for="c_login">Login</label>
    <input type="text" id="c_login" name="login">
    <label for="c_password">Mot de passe</label>
    <input type="password" id="c_password" name="password">
    <input type="submit" value="Se connecter">
</form>

<form method="post">
    <h2>Inscription</h2>
    <input type="hidden" name="action" value="inscription">
    <label for="i_login">Login</label>
    <input type="text" id="i_login" name="login">
    <label for="i_password">Mot de passe</label>
    <input type="password" id="i_password" name="password">
    <input type="submit" value="S'inscrire">
</form>

</body>
</html>