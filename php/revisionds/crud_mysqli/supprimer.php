<?php
require 'db.php';
$connexion = connecter();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $req = mysqli_prepare($connexion, "DELETE FROM etudiants WHERE id = ?");
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);
}

header("Location:liste.php");
exit;