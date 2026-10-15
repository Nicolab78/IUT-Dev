<?php
$qte = "";
$cp = "";
$email = "";
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qte   = trim($_POST['qte']);
    $cp    = trim($_POST['cp']);
    $email = trim($_POST['email']);

    if (!ctype_digit($qte) || (int) $qte < 1 || (int) $qte > 10) {
        $erreurs[] = 'La quantité doit être un entier entre 1 et 10';
    }
    if (!preg_match('/^\d{5}$/', $cp)) {
        $erreurs[] = 'Le code postal doit contenir 5 chiffres';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email est invalide";
    }
    if (!isset($_POST['cgu'])) {
        $erreurs[] = 'Il faut accepter les conditions';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E4 - Validation</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        label, input { display: block; margin-bottom: 0.5rem; }
        input[type=checkbox] { display: inline; }
        .erreur { color: firebrick; }
        .succes { color: seagreen; }
    </style>
</head>
<body>

<h1>Validation d'un formulaire</h1>

<?php if (!empty($erreurs)): ?>
    <ul class="erreur">
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur) ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p class="succes">Formulaire valide.</p>
<?php endif; ?>

<form method="post">
    <label for="qte">Quantité (1 à 10)</label>
    <input type="text" id="qte" name="qte" value="<?= htmlspecialchars($qte) ?>">

    <label for="cp">Code postal</label>
    <input type="text" id="cp" name="cp" value="<?= htmlspecialchars($cp) ?>">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

    <label><input type="checkbox" name="cgu" <?= isset($_POST['cgu']) ? 'checked' : '' ?>> J'accepte les conditions</label>

    <input type="submit" value="Valider">
</form>

</body>
</html>