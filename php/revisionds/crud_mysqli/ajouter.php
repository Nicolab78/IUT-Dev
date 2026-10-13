<?php
require "db.php";
$connexion = connecter();

$nom = $prenom = $filiere = '';
$annee = '';
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $filiere = $_POST['filiere'] ?? '';
    $annee = $_POST['annee'] ?? '';

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
        $anneeInt = (int) $annee;
        $req = mysqli_prepare($connexion, 'INSERT INTO etudiants (nom, prenom, filiere, annee) VALUES (?,?,?,?)');
        mysqli_stmt_bind_param($req, 'sssi', $nom, $prenom, $filiere, $anneeInt);
        mysqli_stmt_execute($req);

        header('Location: liste.php');
        exit;
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter Étudiants</title>
</head>
<body>

<?php if (!empty($erreurs)): ?>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur)?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($nom) ?>">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($prenom)?>">
    <label for="filiere">Filière</label>
    <input type="text" name="filiere" value="<?= htmlspecialchars($filiere) ?>">
    <label for="annee">Année</label>
    <input type="number" name="annee" value="<?= htmlspecialchars($annee) ?>">
    <button type="submit">Valider</button>

</form>
<a href="liste.php">Retour</a>


</body>
</html>
