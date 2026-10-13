<?php

$pseudo = $email = '';
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '' );
    $email = trim($_POST['email'] ?? '' );
    $mdp = $_POST['mdp'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    if (empty($pseudo)) {
        $erreurs['pseudo'] = 'Veuillez entrer votre nom';
    }

    if (empty($email)) {
        $erreurs['email'] = 'Veuillez entrer votre adresse mail';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Veuillez entrer une adresse mail correct';
    }

    if (empty($mdp)) {
        $erreurs[] = 'Veuillez entrer votre mot de passe';
    } elseif (strlen($mdp) < 8) {
        $erreurs[] = 'Le mot de passe doit faire au minimum 8 caractère';
    }

    if (empty($confirmation)) {
        $erreurs[] = 'Veuillez confirmer votre mot de passe';
    }
}

$succes = $_SERVER['REQUEST_METHOD'] == 'POST' && empty($erreurs);

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body>

<?php if (!empty($erreurs)):?>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur)?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($succes): ?>
    <p>Inscription réussie, bienvenue <?= htmlspecialchars($pseudo)?> !</p>
<?php endif; ?>

<form method="post">

    <div>
        <label for="pseudo">Pseudo</label>
        <input type="test" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
    </div>

    <div>
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp">
    </div>

    <div>
        <label for="confirmation">Confirmation</label>
        <input type="password" id="confirmation" name="confirmation">
    </div>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
