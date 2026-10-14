<?php
function loginExiste(string $login): bool {
    $fichier = fopen('users.csv', 'r');
    fgetcsv($fichier, null, ',', '"', '\\');
    while (($ligne = fgetcsv($fichier, null, ',', '"', '\\')) !== false) {
        if (count($ligne) >= 2 && $ligne[0] === $login) {
            fclose($fichier);
            return true;
        }
    }
    fclose($fichier);
    return false;
}

function ajouterUser(string $login, string $password): void {
    $contenu = file_get_contents('users.csv');
    $fichier = fopen('users.csv', 'a');
    if ($contenu !== '' && substr($contenu, -1) !== "\n") {
        fwrite($fichier, "\n");
    }
    fputcsv($fichier, [$login, md5($password)], ',', '"', '\\');
    fclose($fichier);
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

    if (empty($erreurs) && loginExiste($login)) {
        $erreurs[] = "Ce login est déjà utilisé";
    }

    if (empty($erreurs)) {
        ajouterUser($login, $password);
        $inscrit = true;
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