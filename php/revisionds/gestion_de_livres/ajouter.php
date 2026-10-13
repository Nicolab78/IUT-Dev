<?php
require 'db.php';
require 'auth.php';
exigerAdmin();
$connexion = connecter();

$titre = $auteur = $annee = '';
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre  = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    $annee  = trim($_POST['annee'] ?? '');

    if ($titre === '')  $erreurs[] = 'Le titre est obligatoire';
    if ($auteur === '') $erreurs[] = "L'auteur est obligatoire";
    if (!ctype_digit($annee) || (int) $annee < 1000 || (int) $annee > (int) date('Y')) {
        $erreurs[] = "L'année est invalide";
    }

    if (empty($erreurs)) {
        $anneeInt = (int) $annee;
        $req = mysqli_prepare($connexion, 'INSERT INTO livres (titre, auteur, annee) VALUES (?, ?, ?)');
        mysqli_stmt_bind_param($req, 'ssi', $titre, $auteur, $anneeInt);
        mysqli_stmt_execute($req);

        header('Location: liste.php');
        exit;
    }
}

require 'header.php';
?>
    <h1>Ajouter un livre</h1>
<?php foreach ($erreurs as $erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endforeach; ?>

    <form method="post">
        <label>Titre <input type="text" name="titre" value="<?= htmlspecialchars($titre) ?>"></label><br>
        <label>Auteur <input type="text" name="auteur" value="<?= htmlspecialchars($auteur) ?>"></label><br>
        <label>Année <input type="number" name="annee" value="<?= htmlspecialchars($annee) ?>"></label><br>
        <button type="submit">Ajouter</button>
    </form>
<?php require 'footer.php'; ?>