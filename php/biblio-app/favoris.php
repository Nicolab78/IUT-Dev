<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

if (isset($_GET['ajouter'])) {
    $titre = $_GET['ajouter'];
    if (!in_array($titre, $_SESSION['favoris'], true)) {
        $_SESSION['favoris'][] = $titre;
    }
    header('Location: /favoris.php');
    exit;
}

if (isset($_GET['retirer'])) {
    $titre = $_GET['retirer'];
    $_SESSION['favoris'] = array_values(array_filter(
        $_SESSION['favoris'],
        fn($t) => $t !== $titre
    ));
    header('Location: /favoris.php');
    exit;
}

require __DIR__ . '/includes/header.php';
?>

<h1>Mes favoris (session)</h1>

<?php if (empty($_SESSION['favoris'])): ?>
    <p>Aucun favori pour l'instant — ajoute-en depuis la <a href="/livres.php">liste des livres</a>.</p>
<?php else: ?>
    <ul>
        <?php foreach ($_SESSION['favoris'] as $titre): ?>
            <li>
                <?= htmlspecialchars($titre) ?>
                — <a href="/favoris.php?retirer=<?= urlencode($titre) ?>">retirer</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
