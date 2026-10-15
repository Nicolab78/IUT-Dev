<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table de multiplication</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<table>
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <tr>
            <?php for ($j = 1; $j <= 10; $j++): ?>
                <td class="<?= ($i + $j) % 2 === 0 ? 'pair' : 'impair' ?>"><?= $i * $j ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

</body>
</html>