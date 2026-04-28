<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['nome']) || $_SESSION['nome'] === '') {
    session_destroy();
    header('Location: index.php');
    exit;
}
