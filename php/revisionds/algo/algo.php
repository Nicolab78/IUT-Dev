<?php

function estPalindrome(string $texte): bool {
    $lettres = mb_str_split(mb_strtolower(preg_replace('/[^\p{L}\p{N}]/u', '', $texte)));
    $i = 0;
    $j = count($lettres) - 1;
    while ($i < $j) {
        if ($lettres[$i] !== $lettres[$j]) {
            return false;
        }
        $i++;
        $j--;
    }
    return true;
}

function estPremier(int $n): bool {
    if ($n < 2) {
        return false;
    }
    for ($d = 2; $d * $d <= $n; $d++) {
        if ($n % $d === 0) {
            return false;
        }
    }
    return true;
}

function fizzBuzz(int $n): array {
    $sortie = [];
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 15 === 0) {
            $sortie[] = 'FizzBuzz';
        } elseif ($i % 3 === 0) {
            $sortie[] = 'Fizz';
        } elseif ($i % 5 === 0) {
            $sortie[] = 'Buzz';
        } else {
            $sortie[] = $i;
        }
    }
    return $sortie;
}

function triBulles(array $t): array {
    $echanges = 0;
    $n = count($t);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - 1 - $i; $j++) {
            if ($t[$j] > $t[$j + 1]) {
                $tmp = $t[$j];
                $t[$j] = $t[$j + 1];
                $t[$j + 1] = $tmp;
                $echanges++;
            }
        }
    }
    return [$t, $echanges];
}

function fibonacci(int $n): array {
    $suite = [];
    $a = 0;
    $b = 1;
    for ($i = 0; $i < $n; $i++) {
        $suite[] = $a;
        [$a, $b] = [$b, $a + $b];
    }
    return $suite;
}

function pgcd(int $a, int $b): int {
    while ($b !== 0) {
        [$a, $b] = [$b, $a % $b];
    }
    return abs($a);
}

function versBinaire(int $n): string {
    if ($n === 0) {
        return '0';
    }
    $resultat = '';
    while ($n > 0) {
        $resultat = ($n % 2) . $resultat;
        $n = intdiv($n, 2);
    }
    return $resultat;
}

function depuisBinaire(string $binaire): int {
    $n = 0;
    foreach (str_split($binaire) as $bit) {
        $n = $n * 2 + (int) $bit;
    }
    return $n;
}

function dichotomie(array $t, int $cible): array {
    $bas = 0;
    $haut = count($t) - 1;
    $etapes = 0;
    while ($bas <= $haut) {
        $etapes++;
        $milieu = intdiv($bas + $haut, 2);
        if ($t[$milieu] === $cible) {
            return [$milieu, $etapes];
        }
        if ($t[$milieu] < $cible) {
            $bas = $milieu + 1;
        } else {
            $haut = $milieu - 1;
        }
    }
    return [-1, $etapes];
}

function entiers(string $texte): ?array {
    $morceaux = preg_split('/[\s,;]+/', trim($texte), -1, PREG_SPLIT_NO_EMPTY);
    $nombres = [];
    foreach ($morceaux as $m) {
        if (!preg_match('/^-?\d+$/', $m)) {
            return null;
        }
        $nombres[] = (int) $m;
    }
    return count($nombres) > 0 ? $nombres : null;
}


$exos = [
    'palindrome' => ['Palindrome', 'Esope reste ici et se repose'],
    'premiers'   => ['Nombres premiers jusqu\'à n', '30'],
    'fizzbuzz'   => ['FizzBuzz jusqu\'à n', '15'],
    'tri'        => ['Tri à bulles', '5, 2, 9, 1, 7'],
    'fibonacci'  => ['Suite de Fibonacci (n termes)', '10'],
    'pgcd'       => ['PGCD et PPCM de deux nombres', '84, 36'],
    'binaire'    => ['Décimal vers binaire', '42'],
    'decimal'    => ['Binaire vers décimal', '101010'],
    'dicho'      => ['Recherche dichotomique (liste triée ; cible)', '2, 5, 8, 12, 16, 23, 38 ; 23'],
    'mots'       => ['Voyelles, mots et mot le plus long', 'Le php est un langage de script'],
];

$exo = $_POST['exo'] ?? 'palindrome';
if (!isset($exos[$exo])) {
    $exo = 'palindrome';
}
$saisie = $_POST['saisie'] ?? $exos[$exo][1];
$resultat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = entiers($saisie);

    switch ($exo) {
        case 'palindrome':
            $resultat = estPalindrome($saisie) ? 'Oui, c\'est un palindrome' : 'Non, ce n\'est pas un palindrome';
            break;

        case 'premiers':
            if ($nombres === null || $nombres[0] < 2 || $nombres[0] > 1000) {
                $resultat = 'Entrez un entier entre 2 et 1000';
                break;
            }
            $liste = [];
            for ($i = 2; $i <= $nombres[0]; $i++) {
                if (estPremier($i)) {
                    $liste[] = $i;
                }
            }
            $resultat = count($liste) . ' nombres premiers : ' . implode(', ', $liste);
            break;

        case 'fizzbuzz':
            if ($nombres === null || $nombres[0] < 1 || $nombres[0] > 200) {
                $resultat = 'Entrez un entier entre 1 et 200';
                break;
            }
            $resultat = implode(' ', fizzBuzz($nombres[0]));
            break;

        case 'tri':
            if ($nombres === null) {
                $resultat = 'Entrez des nombres entiers séparés par des virgules';
                break;
            }
            [$trie, $echanges] = triBulles($nombres);
            $resultat = implode(', ', $trie) . " ($echanges échange(s))";
            break;

        case 'fibonacci':
            if ($nombres === null || $nombres[0] < 1 || $nombres[0] > 50) {
                $resultat = 'Entrez un entier entre 1 et 50';
                break;
            }
            $resultat = implode(', ', fibonacci($nombres[0]));
            break;

        case 'pgcd':
            if ($nombres === null || count($nombres) !== 2 || $nombres[0] === 0 || $nombres[1] === 0) {
                $resultat = 'Entrez deux entiers non nuls, par exemple 84, 36';
                break;
            }
            $d = pgcd($nombres[0], $nombres[1]);
            $resultat = "PGCD = $d, PPCM = " . abs($nombres[0] / $d * $nombres[1]);
            break;

        case 'binaire':
            if ($nombres === null || $nombres[0] < 0) {
                $resultat = 'Entrez un entier positif';
                break;
            }
            $resultat = $nombres[0] . ' = ' . versBinaire($nombres[0]) . ' en binaire';
            break;

        case 'decimal':
            if (!preg_match('/^[01]+$/', trim($saisie))) {
                $resultat = 'Entrez seulement des 0 et des 1';
                break;
            }
            $resultat = trim($saisie) . ' en binaire = ' . depuisBinaire(trim($saisie));
            break;

        case 'dicho':
            $parties = explode(';', $saisie);
            $liste = entiers($parties[0]);
            $cible = isset($parties[1]) ? entiers($parties[1]) : null;
            if ($liste === null || $cible === null) {
                $resultat = 'Format attendu : liste triée ; cible';
                break;
            }
            [$position, $etapes] = dichotomie($liste, $cible[0]);
            $resultat = $position >= 0
                ? "Trouvé à la position $position en $etapes étape(s)"
                : "Absent de la liste ($etapes étape(s))";
            break;

        case 'mots':
            $mots = preg_split('/\s+/u', trim($saisie), -1, PREG_SPLIT_NO_EMPTY);
            $voyelles = preg_match_all('/[aeiouyàâäéèêëîïôöùûü]/iu', $saisie);
            $plusLong = '';
            foreach ($mots as $mot) {
                if (mb_strlen($mot) > mb_strlen($plusLong)) {
                    $plusLong = $mot;
                }
            }
            $resultat = count($mots) . " mot(s), $voyelles voyelle(s), mot le plus long : $plusLong";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Exercices d'algo</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { padding: 1rem; background-color: whitesmoke; display: inline-block; }
        label, input, select { display: block; margin-bottom: 0.5rem; }
        input[type=text] { width: 28rem; max-width: 100%; }
        .resultat { margin-top: 1rem; padding: 0.7rem 1rem; background-color: honeydew; border-left: 0.25rem solid seagreen; }
    </style>
</head>
<body>

<h1>Exercices d'algo</h1>

<form method="post">
    <label for="exo">Exercice</label>
    <select name="exo" id="exo">
        <?php foreach ($exos as $cle => $infos): ?>
            <option value="<?= $cle ?>" <?= $cle === $exo ? 'selected' : '' ?>><?= htmlspecialchars($infos[0]) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="saisie">Entrée</label>
    <input type="text" name="saisie" id="saisie" value="<?= htmlspecialchars($saisie) ?>">

    <input type="submit" value="Lancer">
</form>

<?php if ($resultat !== ''): ?>
    <p class="resultat"><?= htmlspecialchars($resultat) ?></p>
<?php endif; ?>

</body>
</html>