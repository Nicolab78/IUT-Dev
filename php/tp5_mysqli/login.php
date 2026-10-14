<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
        }

        form {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: whitesmoke;
        }

        label, input {
            display: block;
            margin-bottom: 0.5rem;
        }

        .erreur {
            color: firebrick;
        }
    </style>
</head>
<body>

<h1>Connexion</h1>

<?php if (isset($_GET['error'])): ?>
    <p class="erreur">Login ou mot de passe incorrect.</p>
<?php endif; ?>

<form action="logdb.php" method="post">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" placeholder="login">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="password">

    <input type="submit" value="Valider">
    <p>Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
</form>

</body>
</html>