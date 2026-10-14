<?php

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $filiere = $_POST['filiere'] ?? '';
    $notePhp  = $_POST['note_php'] ?? '';
    $noteSql  = $_POST['note_sql'] ?? '';

    if (empty($nom)) {
        $erreur[] = "Le champ nom est obligatoire";
    }

    if (empty($prenom)) {
        $erreur[] = "Le champ prenom est obligatoire";
    }

    if (!in_array($filiere, ['Informatique','Réseaux'], true)) {
        $erreur[] = "Filière invalide";
    }

    foreach (['PHP' => $notePhp, 'SQL' => $noteSql] as $matiere => $note) {
        if (!is_numeric($note) || $note < 0 || $note > 20) {
            $erreurs[] = "Note $matiere invalide (entre 0 et 20)";
        }
    }

    if (empty($erreurs)) {
        $f = fopen('eleves.csv', 'a');
        fputcsv($f, [$nom, $prenom, $filiere, $notePhp, $noteSql, 0]);
        fclose($f);
        header('Location: index.php');
        exit;
    }
}
?>

<?php foreach ($erreurs as $erreur): ?>
    <p><?= htmlspecialchars($erreur) ?></p>
<?php endforeach; ?>


<form method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <select name="filiere">
        <option>Informatique</option>
        <option>Réseaux</option>
    </select>
    <input type="text" name="note_php" placeholder="Note PHP">
    <input type="text" name="note_sql" placeholder="Note SQL">
    <button type="submit">Ajouter</button>
</form>