<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['nome']) || $_SESSION['nome'] === '') {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Compatibilidade: páginas que exibem a saudação via $_SESSION['USUARIO']
if (!isset($_SESSION['USUARIO'])) {
    $_SESSION['USUARIO'] = $_SESSION['nome'];
}
