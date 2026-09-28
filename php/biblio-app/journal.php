<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

if (isset($_GET['vider'])) {
    file_put_contents(JOURNAL_TXT, '');
    header('Location: /journal.php');
    exit;
}

$lignes = lireJournal(JOURNAL_TXT, 30);

require __DIR__ . '/includes/header.php';
?>

<h1>Journal d'activité (fichier .txt)</h1>
<p>Chaque visite sur "Livres", chaque ajout de livre et chaque recherche est loggé ici,
via <code>file_put_contents(..., FILE_APPEND)</code>.</p>

<p><a href="/journal.php?vider">Vider le journal</a></p>

<?php if (empty($lignes)): ?>
    <p>Le journal est vide.</p>
<?php else: ?>
    <div class="journal">
        <?php foreach (array_reverse($lignes) as $ligne): ?>
            <?= htmlspecialchars($ligne) ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
