<?php

session_start();
if (!isset($_SESSION['USUARIO'])) {
    header('Location: login.php');
    exit;
}