<?php
require 'db.php';
require 'auth.php';
exigerConnexion();

$connexion = connecter();

$resultat = mysqli_query($connexion, 'SELECT * FROM livres ORDER BY id DESC');

$dernier = $_COOKIE['dernier_livre'] ?? null;
require 'header.php';


?>

<h1>Livres</h1>

<?php if ($dernier): ?>
    <p>Dernier livre consulté : <?= htmlspecialchars($dernier)?></p>
<?php endif; ?>

<table>
    <tr><th>Titre</th><th>Auteur</th><th>Année</th><th>Actions</th></tr>
    <?php while ($livre = mysqli_fetch_assoc($resultat)): ?>
        <tr>
            <td><a href="livre.php?id=<?= (int) $livre['id']?>"><?= htmlspecialchars($livre['titre']) ?></a></td>
            <td><?= htmlspecialchars($livre['auteur'])?></td>
            <td><?= (int) $livre['annee']?></td>
            <td>
                <?php if ($dernier): ?>
                <a href="editer.php?id=<?= (int) $livre['id'] ?>">Éditer</a>
                <form action="supprimer.php" method="post" style="display: inline" onsubmit="return confirm('Supprimer ce livre ?')">
                    <input type="hidden" name="id" value="<?= (int) $livre['id']?>">
                    <button type="submit">Supprimer</button>

                </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php require 'footer.php'; ?>
