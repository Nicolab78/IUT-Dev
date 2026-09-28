<?php
session_start();

define('LIVRES_CSV', __DIR__ . '/data/livres.csv');
define('JOURNAL_TXT', __DIR__ . '/data/journal.txt');

if (!isset($_SESSION['favoris'])) {
    $_SESSION['favoris'] = [];
}
