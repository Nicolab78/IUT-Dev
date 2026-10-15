<?php
session_start();

if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = rand(1, 100);
    $_SESSION['essais'] = 0;
    $_SESSION['gagne'] = false;
}

$message = '';
$proposition = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rejouer'])) {
        unset($_SESSION['secret'], $_SESSION['essais'], $_SESSION['gagne']);
        header('Location: plusmoins.php');
        exit;
    }

    $proposition = trim($_POST['proposition']);
    if ($_SESSION['gagne']) {
        $message = 'La partie est finie, cliquez sur Rejouer';
    } elseif (!ctype_digit($proposition)) {
        $message = 'Entrez un nombre entier';
    } else {
        $_SESSION['essais']++;
        if ((int) $proposition < $_SESSION['secret']) {
            $message = 'C\'est plus !';
        } elseif ((int) $proposition > $_SESSION['secret']) {
            $message = 'C\'est moins !';
        } else {
            $_SESSION['gagne'] = true;
            $message = 'Bravo, trouvé en ' . $_SESSION['essais'] . ' essai(s) !';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Plus ou moins</title>
</head>
<body>
<h1>Plus ou moins</h1>
<p>Devinez le nombre entre 1 et 100. Essais : <?= $_SESSION['essais'] ?></p>

<?php if (!$_SESSION['gagne']): ?>
    <form method="post">
        <input type="text" name="proposition" value="<?= htmlspecialchars($proposition) ?>" autofocus>
        <input type="submit" value="Valider">
    </form>
<?php endif; ?>

<?php if ($message !== ''): ?>
    <p><strong><?= htmlspecialchars($message) ?></strong></p>
<?php endif; ?>

<form method="post">
    <input type="submit" name="rejouer" value="Rejouer">
</form>
</body>
</html>