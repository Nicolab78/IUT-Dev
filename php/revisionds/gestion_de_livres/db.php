<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function connecter(): mysqli{
    $connexion = mysqli_connect("127.0.0.1", "root", "rootroot", "bibliophp");
    mysqli_set_charset($connexion, "utf8");
    return $connexion;
}

