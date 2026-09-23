<?php
session_start();

if (!isset($_SESSION['taches'])){
    $_SESSION['taches'] = [];
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'ajouter') {
        $nouvelleTache = trim($_POST['nouvelle_tache']);

        if ($nouvelleTache === "") {
            $erreurs[] = "La tâche ne peut pas être vide";
        } else {
            $_SESSION['taches'][] = ["texte" => $nouvelleTache, "terminee" => false];
        }
    } elseif (str_starts_with($_POST['action'], 'cocher_')) {
        $index = (int) str_replace('cocher_', '', $_POST['action']);
        $_SESSION['taches'][$index]['terminee'] = !$_SESSION['taches'][$index]['terminee'];
    } elseif (str_starts_with($_POST['action'], 'supprimer_')) {
        $index = (int) str_replace('supprimer_', '', $_POST['action']);
        unset($_SESSION['taches'][$index]);
        $_SESSION['taches'] = array_values($_SESSION['taches']);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
</head>
<body>

<?php if (!empty($erreurs)): ?>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= $erreur ?></li>
        <?php endforeach; ?>
    </ul> 
<?php endif; ?>

<form method="post" action="todo.php">
    <input type="text" name="nouvelle_tache">
    <button type="submit" name="action" value="ajouter">Ajouter</button>

</form>

<ul>
    <?php foreach ($_SESSION['taches'] as $index => $tache): ?>
        <li>
            <?php if ($tache['terminee']): ?>
                <s><?= htmlspecialchars($tache['texte']) ?></s>
            <?php else: ?>
                <?= htmlspecialchars($tache['texte']) ?>
            <?php endif; ?>
            <form method="post" action="todo.php" style="display:inline">
                <button type="submit" name="action" value="cocher_<?= $index ?>">Cocher</button>
            </form>
            <form method="post" action="todo.php" style="display:inline">
                <button type="submit" name="action" value="supprimer_<?= $index ?>">Supprimer</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
    
</body>
</html>