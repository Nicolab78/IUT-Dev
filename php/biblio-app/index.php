<?php
require __DIR__ . '/config.php';
require __DIR__ . '/fonctions.php';

$livres = lireLivres(LIVRES_CSV);
$nbLivres = count($livres);
$nbLus = count(array_filter($livres, fn($l) => $l['lu'] === 'oui'));

require __DIR__ . '/includes/header.php';
?>

<h1>Ma bibliothèque personnelle</h1>
<p>Petit projet PHP procédural : plusieurs pages liées par <code>include</code>,
lecture/écriture de fichiers CSV et TXT, et un peu de session pour les favoris.</p>

<p>
    Livres enregistrés : <strong><?= $nbLivres ?></strong><br>
    Livres lus : <strong><?= $nbLus ?></strong> / <?= $nbLivres ?><br>
    Favoris en session : <strong><?= count($_SESSION['favoris']) ?></strong>
</p>

<p>Utilise le menu ci-dessus pour naviguer entre les pages.</p>

<?php require __DIR__ . '/includes/footer.php'; ?>
