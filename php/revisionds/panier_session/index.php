<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['vider'])) {
        $_SESSION['panier'] = [];
    } else {
        $article = trim($_POST['article'] ?? '');
        if ($article !== '') {
            $_SESSION['panier'][] = $article;
        }
    }
    header('Location: ex7.php');
    exit;
}

$_SESSION['visites'] = ($_SESSION['visites'] ?? 0) + 1;   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E7 - Panier</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
    </style>
</head>
<body>

<h1>Panier en session</h1>
<p>Nombre d'affichages de cette page : <?= $_SESSION['visites'] ?></p>

<form method="post">
    <input type="text" name="article" placeholder="article">
    <input type="submit" value="Ajouter">
    <input type="submit" name="vider" value="Vider le panier">
</form>

<?php if (empty($_SESSION['panier'])): ?>
    <p>Le panier est vide.</p>
<?php else: ?>
    <ul>
        <?php foreach ($_SESSION['panier'] as $article): ?>
            <li><?= htmlspecialchars($article) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>