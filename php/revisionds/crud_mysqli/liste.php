<?php

require 'db.php';
$connexion = connecter();

$recherche = trim($_GET['q'] ?? '');
$motif = '%'.$recherche.'%';

$sql = 'SELECT * FROM etudiants WHERE nom LIKE ? OR prenom LIKE ? ORDER BY id DESC';
$req = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($req, 'ss',$motif, $motif);
mysqli_stmt_execute($req);
$resultat = mysqli_stmt_get_result($req);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste Étudiants</title>
</head>
<body>

<form method="get">
    <input type="text" name="q" value="<?= htmlspecialchars($recherche) ?>" placeholder="Rechercher">
    <input type="submit" value="OK">
</form>

<a href="ajouter.php">Ajouter</a>

<table border="1">
    <tr><th>Nom</th><th>Prénom</th><th>Filière</th><th>Année</th><th>Actions</th></tr>
    <?php while ($e = mysqli_fetch_assoc($resultat)): ?>
        <tr>
            <td><?= htmlspecialchars($e['nom'])?></td>
            <td><?= htmlspecialchars($e['prenom'])?></td>
            <td><?= htmlspecialchars($e['filiere'])?></td>
            <td><?= (int) $e['annee'] ?></td>

            <td>
                <a href="editer.php?id=<?= (int) $e['id'] ?>">Éditer</a>
                <form action="supprimer.php" method="post" style="display:inline" onsubmit="return confirm('Supprimer cet étudiant ?');">
                    <input type="hidden" name="id" value="<?= (int) $e['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
                
            </td>
        </tr>
    
    <?php endwhile; ?>
</table>


</body>
</html>
