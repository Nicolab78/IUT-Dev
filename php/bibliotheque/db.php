<?php
$hote = 'localhost';
$nomBdd = 'biblio-php-crud';
$utilisateur = 'root';
$motDePasse = 'rootroot'; 

try {
    $pdo = new PDO("mysql:host=$hote;dbname=$nomBdd;charset=utf8mb4", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>