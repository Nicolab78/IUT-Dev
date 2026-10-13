<?php
require 'db.php';
require 'auth.php';
exigerConnexion();

$connexion = connecter();

$id = (int) ($_GET['id'] ?? 0);

$req = mysqli_prepare($connexion, 'SELECT * FROM livres WHERE id = ?');
mysqli_stmt_bind_param($req, 'i', $id);
mysqli_stmt_execute($req);
$livre = mysqli_fetch_assoc(mysqli_stmt_get_result($req));

if (!$livre){
    header('Location: liste.php');
    exit;
}

setcookie('dernier_livre', $livre['titre'], time() + 7 * 24 * 3600);

require 'header.php';

?>

<h1><?= htmlspecialchars($livre['titre'])?></h1>
<p>Auteur : <?= htmlspecialchars($livre['auteur']) ?></p>
<p>Année : <?= (int) $livre['annee']?></p>
<a href="liste.php">Retour</a>
<?php require 'footer.php'; ?>