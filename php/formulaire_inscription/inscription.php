<?php
session_start();

$pseudo = "";
$email = "";
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);

    if ($pseudo === "") {
        $erreurs[] = "Le pseudo est obligatoire";
    }

    if ($email === "") {
        $erreurs[] = "L'email est obligatoire";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $erreurs[] = "Le format de l'email est invalide";
}
}                                          

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

<?php if (!empty($erreurs)): ?>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= $erreur ?></li>
        <?php endforeach; ?>
    </ul> 
<?php endif; ?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($erreurs)): ?>
    <p>Inscription réussie, bienvenue <?= htmlspecialchars($pseudo) ?> !</p>
<?php endif; ?>

<form method="post" action="inscription.php">
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>">
    </div>

    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
    </div>

    <button type="submit">S'inscrire</button>
</form>
    
</body>
</html>