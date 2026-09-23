<?php include("heads.php"); ?>
<?php include("fonction.php"); ?>
<h2>TP 2</h2>
<?php

$caractere = array(1,2,3,4,5,6,7,8,9);
$effectif = array(10,5,6,7,8,9,1,5,4);
$fonction = array(
    "moyenne" => "Moyenne",
    "variance" => "Variance",
    "ecarttype" => "Écart type"
);

echo '<table class="noir">';
echo "<tr><th>Caractère</th>";
foreach ($caractere as $val) {
    echo "<td>".$val."</td>";
}

echo "</tr>";
echo "<tr><th>Effectif</th>";
foreach ($effectif as $val) {
    echo "<td>".$val."</td>";
}

echo "</tr>";
echo "</table>";

echo '<table class="rouge">';
echo "<tr><th>Caractere</th><th>Effectif</th></tr>";
for ($i = 0; $i < count($effectif); $i++) {
    echo "<tr><td>" .$caractere[$i]."</td><td>" .$effectif[$i]. "</td></tr>";
}
echo "</table>";

$choix = $_POST["stats"] ?? "";
$valeur = "";

switch ($choix) {
    case "moyenne":
        $valeur = round(moyenne($caractere, $effectif), 2);
        break;
    case "variance":
        $valeur = round(variance($caractere, $effectif), 2);
        break;
    case "ecarttype":
        $valeur = round(ecarttype($caractere, $effectif), 2);
        break;
}

echo '<div class="conteneur">';
echo "<h3>Formulaire de stats</h3>";
echo '<form action="" method="POST">';
echo '<label for="stats">Statistiques</label>';
echo '<select id="stats" name="stats">';
echo "<option value='moyenne'". ($choix == "moyenne" ? " selected" : "") .">Moyenne</option>";
echo "<option value='variance'". ($choix == "variance" ? " selected" : "") .">Variance</option>";
echo "<option value='ecarttype'". ($choix == "ecarttype" ? " selected" : "") .">Écart type</option>";
echo "</select>";
echo "<br>";
echo "<br>";
echo "<input type='submit' value='Calculer'>";
echo "<br>";
echo "<br>";
echo "<label for='resultat'>Résultat</label>";
echo "<input type='text' id='resultat' value='$valeur' readonly>";
echo "</form>";
echo "</div>";

?>

<?php include("footer.php")?>