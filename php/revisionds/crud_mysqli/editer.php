<?php
require 'db.php';
$connexion = connecter();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

$req = mysqli_prepare($connexion, 'SELECT * FROM etudiants WHERE id = ?');
mysqli_stmt_bind_param($req, 'i', $id);
mysqli_stmt_execute($req);
$etudiant = mysqli_fetch_assoc(mysqli_stmt_get_result($req));

if (!$etudiant) {
    header('Location: liste.php');
    exit;
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $filiere = trim($_POST['filiere'] ?? '');
    $annee = (int) ($_POST['annee'] ?? 0);

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire";
    }

    if (empty($prenom)) {
        $erreurs[] = "Le prenom est obligatoire";
    }

    if (empty($filiere)) {
        $erreurs[] = "Le filiere est obligatoire";
    }

    if (empty($annee)) {
        $erreurs[] = "L'annee est obligatoire";
    }

    if (empty($erreurs)) {
        $req = mysqli_prepare($connexion,
            'UPDATE etudiants SET nom = ?, prenom = ?, filiere = ?, annee = ? WHERE id = ?');
        mysqli_stmt_bind_param($req, 'sssii', $nom, $prenom, $filiere, $annee, $id);
        mysqli_stmt_execute($req);

        header('Location: liste.php');
        exit;
    }

    $etudiant = ['nom' => $nom, 'prenom' => $prenom, 'filiere' => $filiere, 'annee' => $annee];

}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php foreach($erreurs as $erreur): ?>
    <p><?= htmlspecialchars($erreur)?></p>
<?php endforeach; ?>


<form method="post">
    <input type="hidden" name="id" value="<?= $id?>">
    <label for="nom">Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>">
    <label for="filiere">Filière</label>
    <input type="text" name="filiere" value="<?= htmlspecialchars($etudiant['filiere']) ?>">
    <label for="annee">Année</label>
    <input type="number" name="annee" value="<?= (int) $etudiant['annee']?>">
    <button type="submit">Enregistrer</button>


</form>
<a href="liste.php">Retour</a>
</body>
</html>
