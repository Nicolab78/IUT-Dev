<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function exigerConnexion(): void {
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
        exit;
    }
}

function exigerAdmin(): void {
    exigerConnexion();
    if (($_SESSION['role'] ?? '') !== 'admin') {
        header('Location: liste.php');
        exit;
    }
}

function estAdmin(): bool {
    return ($_SESSION['role'] ?? '') === 'admin';
}