<?php
require __DIR__ . '/db.php';
$connexion = connecter();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'ajouter') {
        $nom   = trim($_POST['nom'] ?? '');
        $cat   = trim($_POST['categorie'] ?? '');
        $prix  = (float) ($_POST['prix'] ?? 0);
        $stock = (int) ($_POST['stock'] ?? 0);

        $req = mysqli_prepare($connexion, 'INSERT INTO produits (nom, categorie, prix, stock) VALUES (?, ?, ?, ?)');
        mysqli_stmt_bind_param($req, 'ssdi', $nom, $cat, $prix, $stock);       // s s d i
        mysqli_stmt_execute($req);
        $message = 'Produit ajouté, id = ' . mysqli_stmt_insert_id($req);

    } elseif ($action === 'vendre') {
        $id  = (int) ($_POST['id'] ?? 0);
        $qte = (int) ($_POST['qte'] ?? 0);

        $req = mysqli_prepare($connexion, 'UPDATE produits SET stock = stock - ? WHERE id = ? AND stock >= ?');
        mysqli_stmt_bind_param($req, 'iii', $qte, $id, $qte);
        mysqli_stmt_execute($req);
        $message = mysqli_stmt_affected_rows($req) === 1
            ? 'Vente enregistrée'
            : 'Stock insuffisant ou produit introuvable';

    } elseif ($action === 'supprimer') {
        $id = (int) ($_POST['id'] ?? 0);

        $req = mysqli_prepare($connexion, 'DELETE FROM produits WHERE id = ?');
        mysqli_stmt_bind_param($req, 'i', $id);
        mysqli_stmt_execute($req);
        $message = mysqli_stmt_affected_rows($req) . ' ligne(s) supprimée(s)';
    }
}

$res = mysqli_query($connexion, 'SELECT id, nom, categorie, prix, stock FROM produits ORDER BY id');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>E11 - INSERT, UPDATE, DELETE</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { display: inline-block; vertical-align: top; margin: 0 1rem 1rem 0; padding: 1rem; background-color: whitesmoke; }
        label, input { display: block; margin-bottom: 0.5rem; }
        table { border-collapse: collapse; }
        th, td { border: 0.0625rem solid gray; padding: 0.3rem 0.8rem; }
        .message { font-weight: bold; color: steelblue; }
    </style>
</head>
<body>

<h1>Gestion des produits</h1>

<?php if ($message !== ''): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <h2>Ajouter</h2>
    <input type="hidden" name="action" value="ajouter">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom">
    <label for="categorie">Catégorie</label>
    <input type="text" id="categorie" name="categorie">
    <label for="prix">Prix</label>
    <input type="number" id="prix" name="prix" step="0.01" min="0">
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" min="0">
    <input type="submit" value="Ajouter">
</form>

<form method="post">
    <h2>Vendre</h2>
    <input type="hidden" name="action" value="vendre">
    <label for="v_id">Id du produit</label>
    <input type="number" id="v_id" name="id" min="1">
    <label for="v_qte">Quantité</label>
    <input type="number" id="v_qte" name="qte" min="1">
    <input type="submit" value="Vendre">
</form>

<form method="post">
    <h2>Supprimer</h2>
    <input type="hidden" name="action" value="supprimer">
    <label for="s_id">Id du produit</label>
    <input type="number" id="s_id" name="id" min="1">
    <input type="submit" value="Supprimer">
</form>

<h2>Produits en base</h2>
<table>
    <tr><th>Id</th><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Stock</th></tr>
    <?php while ($p = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= (int) $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nom']) ?></td>
            <td><?= htmlspecialchars($p['categorie']) ?></td>
            <td><?= number_format($p['prix'], 2, ',', ' ') ?> €</td>
            <td><?= (int) $p['stock'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>