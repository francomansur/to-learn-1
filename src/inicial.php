<?php

require_once 'valida.php';


$nome = $_SESSION['USUARIO'];
?>

<div>Bem-vindo, <?php echo $nome; ?>!</div>
<a href="logout.php">Sair</a>


