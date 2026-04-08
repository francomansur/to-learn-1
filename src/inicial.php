<?php
require_once 'valida.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
</div>

