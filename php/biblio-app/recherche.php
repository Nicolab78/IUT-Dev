<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

$requete = trim($_GET['q'] ?? '');
$resultats = [];

if ($requete !== '') {
    $livres = lireLivres(LIVRES_CSV);
    foreach ($livres as $livre) {
        // recherche insensible à la casse dans le titre OU l'auteur
        if (stripos($livre['titre'], $requete) !== false || stripos($livre['auteur'], $requete) !== false) {
            $resultats[] = $livre;
        }
    }
    ajouterJournal(JOURNAL_TXT, "Recherche : \"$requete\" (" . count($resultats) . " résultat(s))");
}

require __DIR__ . '/includes/header.php';
?>

<h1>Rechercher un livre</h1>

<form method="get">
    <label>Titre ou auteur
        <input type="text" name="q" value="<?= htmlspecialchars($requete) ?>">
    </label>
    <button>Rechercher</button>
</form>

<?php if ($requete !== ''): ?>
    <p><?= count($resultats) ?> résultat(s) pour « <?= htmlspecialchars($requete) ?> »</p>
    <?php if ($resultats): ?>
        <table>
            <tr><th>Titre</th><th>Auteur</th><th>Année</th></tr>
            <?php foreach ($resultats as $livre): ?>
                <tr>
                    <td><?= htmlspecialchars($livre['titre']) ?></td>
                    <td><?= htmlspecialchars($livre['auteur']) ?></td>
                    <td><?= htmlspecialchars($livre['annee']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
