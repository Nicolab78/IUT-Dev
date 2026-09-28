<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

$message = '';
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre  = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    $annee  = trim($_POST['annee'] ?? '');
    $lu     = isset($_POST['lu']) ? 'oui' : 'non';

    if ($titre === '') $erreurs[] = 'Le titre est obligatoire.';
    if ($auteur === '') $erreurs[] = "L'auteur est obligatoire.";
    if ($annee !== '' && !ctype_digit($annee)) $erreurs[] = "L'année doit être un nombre.";

    if (empty($erreurs)) {
        ajouterLivre(LIVRES_CSV, $titre, $auteur, $annee, $lu);
        ajouterJournal(JOURNAL_TXT, "Livre ajouté : $titre ($auteur, $annee)");
        $message = "Livre « $titre » ajouté avec succès.";
        // on vide les champs après un ajout réussi
        $titre = $auteur = $annee = '';
        $lu = 'non';
    }
}

require __DIR__ . '/includes/header.php';
?>

<h1>Ajouter un livre</h1>

<?php if ($message): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (!empty($erreurs)): ?>
    <div class="message" style="background:#fde;border-color:crimson">
        <ul>
            <?php foreach ($erreurs as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">
    <label>Titre
        <input type="text" name="titre" value="<?= htmlspecialchars($titre ?? '') ?>">
    </label>
    <label>Auteur
        <input type="text" name="auteur" value="<?= htmlspecialchars($auteur ?? '') ?>">
    </label>
    <label>Année
        <input type="number" name="annee" value="<?= htmlspecialchars($annee ?? '') ?>">
    </label>
    <label>
        <input type="checkbox" name="lu" <?= ($lu ?? '') === 'oui' ? 'checked' : '' ?>>
        Déjà lu
    </label>
    <button>Ajouter</button>
</form>

<?php require __DIR__ . '/includes/footer.php'; ?>
