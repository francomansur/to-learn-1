<?php
if(!isset( $_SESSION['cpf']) || !isset($_SESSION['nome']) ||  !isset($_SESSION['senha'])){
    header("location: login.php");
    exit();
}

?>