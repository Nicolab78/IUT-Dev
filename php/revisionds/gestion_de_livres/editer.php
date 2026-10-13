<?php
require 'db.php';
require 'auth.php';
exigerAdmin();
$connexion = connecter();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

$req = mysqli_prepare($connexion, 'SELECT * FROM livres WHERE id = ?');
mysqli_stmt_bind_param($req, 'i', $id);
mysqli_stmt_execute($req);
$livre = mysqli_fetch_assoc(mysqli_stmt_get_result($req));

if (!$livre) {
    header('Location: liste.php');
    exit;
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre  = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    $annee  = (int) ($_POST['annee'] ?? 0);

    if ($titre === '' || $auteur === '') $erreurs[] = 'Titre et auteur sont obligatoires';
    if ($annee < 1000 || $annee > (int) date('Y')) $erreurs[] = "L'année est invalide";

    if (empty($erreurs)) {
        $req = mysqli_prepare($connexion,
            'UPDATE livres SET titre = ?, auteur = ?, annee = ? WHERE id = ?');
        mysqli_stmt_bind_param($req, 'ssii', $titre, $auteur, $annee, $id);
        mysqli_stmt_execute($req);

        header('Location: liste.php');
        exit;
    }
    $livre = ['titre' => $titre, 'auteur' => $auteur, 'annee' => $annee];
}

require 'header.php';
?>
    <h1>Éditer un livre</h1>
<?php foreach ($erreurs as $erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endforeach; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <label>Titre <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>"></label><br>
        <label>Auteur <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>"></label><br>
        <label>Année <input type="number" name="annee" value="<?= (int) $livre['annee'] ?>"></label><br>
        <button type="submit">Enregistrer</button>
    </form>
<?php require 'footer.php'; ?>