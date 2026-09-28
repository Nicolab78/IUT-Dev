<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

$livres = lireLivres(LIVRES_CSV);
ajouterJournal(JOURNAL_TXT, 'Page Livres consultée (' . count($livres) . ' livres)');

require __DIR__ . '/includes/header.php';
?>

<h1>Tous les livres</h1>

<?php if (empty($livres)): ?>
    <p>Aucun livre enregistré pour le moment.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année</th>
            <th>Lu ?</th>
            <th>Favori</th>
        </tr>
        <?php foreach ($livres as $livre): ?>
            <tr>
                <td><?= htmlspecialchars($livre['titre']) ?></td>
                <td><?= htmlspecialchars($livre['auteur']) ?></td>
                <td><?= htmlspecialchars($livre['annee']) ?></td>
                <td><?= $livre['lu'] === 'oui' ? '✅' : '❌' ?></td>
                <td>
                    <?php if (in_array($livre['titre'], $_SESSION['favoris'], true)): ?>
                        ⭐
                    <?php else: ?>
                        <a href="/favoris.php?ajouter=<?= urlencode($livre['titre']) ?>">+ favori</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
