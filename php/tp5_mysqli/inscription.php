<?php
$connexion = mysqli_connect("localhost", "root", "rootroot", "studentsphp");
function loginExiste($connexion, string $login): bool {
    $req = mysqli_prepare($connexion, "SELECT login FROM users WHERE login = ?");
    mysqli_stmt_bind_param($req, "s", $login);
    mysqli_stmt_execute($req);
    $resultat = mysqli_stmt_get_result($req);
    $existe = mysqli_num_rows($resultat) > 0;
    mysqli_stmt_close($req);
    return $existe;
}

function ajouterUser($connexion, string $login, string $password): bool {
    $req = mysqli_prepare($connexion, "INSERT INTO users (login, password) VALUES (?, ?)");
    $hash = md5($password);
    mysqli_stmt_bind_param($req, "ss", $login, $hash);
    mysqli_stmt_execute($req);
    $ok = mysqli_stmt_affected_rows($req) === 1;           // 1 ligne ajoutée = succès
    mysqli_stmt_close($req);
    return $ok;
}

$login = "";
$erreurs = [];
$inscrit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $confirmation = $_POST['confirmation'];

    if ($login === "") {
        $erreurs[] = "Le login est obligatoire";
    }
    if ($password === "") {
        $erreurs[] = "Le mot de passe est obligatoire";
    } elseif ($password !== $confirmation) {
        $erreurs[] = "Les deux mots de passe sont différents";
    }

    if (empty($erreurs) && loginExiste($connexion, $login)) {
        $erreurs[] = "Ce login est déjà utilisé";
    }

    if (empty($erreurs)) {
        $inscrit = ajouterUser($connexion, $login, $password);
        if (!$inscrit) {
            $erreurs[] = "L'inscription a échoué";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
        }

        form {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: whitesmoke;
        }

        label, input {
            display: block;
            margin-bottom: 0.5rem;
        }

        .erreur {
            color: firebrick;
        }

        .succes {
            color: seagreen;
        }
    </style>
</head>
<body>

<h1>Inscription</h1>

<?php if (!empty($erreurs)): ?>
    <ul class="erreur">
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= $erreur ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($inscrit): ?>
    <p class="succes">Inscription réussie, bienvenue <?= htmlspecialchars($login) ?> !</p>
    <p><a href="login.php">Se connecter</a></p>
<?php endif; ?>

<form action="inscription.php" method="post">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" value="<?= htmlspecialchars($login) ?>">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <label for="confirmation">Confirmer le mot de passe</label>
    <input type="password" name="confirmation" id="confirmation">

    <input type="submit" value="S'inscrire">
</form>

<p><a href="login.php">Retour à la connexion</a></p>

</body>
</html>