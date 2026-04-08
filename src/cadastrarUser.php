<?php
require_once 'valida.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
</div>


<form action="cadastrar.php" method="post" style="margin-top: 48px;">
    <input type="text" name="nome" placeholder="Nome" required class="input"><br>
    <input type="text" name="cpf" placeholder="CPF" required class="input"><br>
    <input type="password" name="senha" placeholder="Senha" required class="input"><br>
    <button type="submit" style="margin-top: 8px;">Cadastrar</button>
</form>

<style>
.input {
    display: block;
    margin-bottom: 4px;
    padding: 8px;
    width: 100%;
    max-width: 300px;
}
</style>