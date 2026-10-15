<?php
require 'garde.php';
$cx = mysqli_connect('localhost', 'root', 'rootroot', 'campus');

if (isset($_GET['min']) && ctype_digit($_GET['min'])) {
    $min = (int) $_GET['min'];
} else {
    $min = (int) ($_COOKIE['dernier_filtre'] ?? 0);
}
setcookie('dernier_filtre', (string) $min, time() + 7 * 24 * 3600);

$req = mysqli_prepare($cx, 'SELECT nom, capacite, etage FROM salles WHERE capacite >= ? ORDER BY capacite DESC');
mysqli_stmt_bind_param($req, 'i', $min);
mysqli_stmt_execute($req);
$res = mysqli_stmt_get_result($req);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Salles</title></head>
<body>
<h1>Salles</h1>
<p>Connecté : <?= htmlspecialchars($_SESSION['login']) ?> | <a href="logout.php">Déconnexion</a> | <a href="ajouter.php">Ajouter</a></p>

<form method="get">
    <label for="min">Capacité minimum</label>
    <input type="number" id="min" name="min" min="0" value="<?= $min ?>">
    <input type="submit" value="Filtrer">
</form>

<?php if (mysqli_num_rows($res) === 0): ?>
    <p>Aucune salle</p>
<?php else: ?>
    <table border="1">
        <tr><th>Nom</th><th>Capacité</th><th>Étage</th></tr>
        <?php while ($s = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?= htmlspecialchars($s['nom']) ?></td>
                <td><?= (int) $s['capacite'] ?></td>
                <td><?= (int) $s['etage'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
</body>
</html>