<?php
session_start();
$erreur = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Connexion</title></head>
<body>
<?php if ($erreur): ?>
    <p>Identifiants incorrects</p>
<?php endif; ?>
<form action="traitement.php" method="post">
    <label for="login">Login</label>
    <input type="text" id="login" name="login">
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Valider">
</form>
</body>
</html>