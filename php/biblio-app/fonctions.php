<?php

function lireLivres($chemin) {
    $livres = [];
    if (!file_exists($chemin)) return $livres;

    $handle = fopen($chemin, 'r');
    fgetcsv($handle);
    while (($ligne = fgetcsv($handle)) !== false) {
        $livres[] = [
            'titre'  => $ligne[0],
            'auteur' => $ligne[1],
            'annee'  => $ligne[2],
            'lu'     => $ligne[3],
        ];
    }
    fclose($handle);
    return $livres;
}

function ajouterLivre($chemin, $titre, $auteur, $annee, $lu) {
    $handle = fopen($chemin, 'a');
    fputcsv($handle, [$titre, $auteur, $annee, $lu]);
    fclose($handle);
}

function ajouterJournal($chemin, $message) {
    $ligne = '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n";
    file_put_contents($chemin, $ligne, FILE_APPEND);
}

function lireJournal($chemin, $nbLignes = 20) {
    if (!file_exists($chemin)) return [];
    $lignes = file($chemin, FILE_IGNORE_NEW_LINES);
    return array_slice($lignes, -$nbLignes);
}
