<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>1 - Grille 8x8</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; }
        td { width: 2.5rem; height: 2.5rem; border: 0.0625rem solid gray; }
        td.vert { background-color: darkseagreen; }
        td.blanc { background-color: white; }
    </style>
</head>
<body>

<table>
    <?php for ($i = 1; $i <= 8; $i++): ?>
        <tr>
            <?php for ($j = 1; $j <= 8; $j++): ?>
                <td class="<?= ($i + $j) % 2 === 0 ? 'vert' : 'blanc' ?>"></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

</body>
</html>