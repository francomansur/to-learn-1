<?php
require_once 'valida.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<style>
    * { font-family: sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f5f5f5; }
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background: #fff; border-bottom: 1px solid #ddd; }
    .navbar a { color: #000000; text-decoration: none; margin-left: 12px; font-size: 0.9rem; }
    .navbar a:hover { text-decoration: underline; }
    .page-body { padding: 24px; }
    .input { display: block; margin-bottom: 8px; padding: 8px; width: 100%; max-width: 300px; border: 1px solid #ccc; }
    .btn { display: inline-block; padding: 8px 20px; background: #2563eb; color: #fff; cursor: pointer; }
    .btn:hover { background: #1d4ed8; }
</style>

<script>
    function cpfValido(cpf) {
        cpf = cpf.replace(/\D/g, '');

        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i), 10) * (10 - i);
        }

        let resto = (soma * 10) % 11;
        if (resto === 10) {
            resto = 0;
        }

        if (resto !== parseInt(cpf.charAt(9), 10)) {
            return false;
        }

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i), 10) * (11 - i);
        }

        resto = (soma * 10) % 11;
        if (resto === 10) {
            resto = 0;
        }

        return resto === parseInt(cpf.charAt(10), 10);
    }

    function validarForm() {
        const form = document.forms[0];
        const cpf = form.cpf.value.trim();
        const senha = form.senha.value;
        const senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$/;

        if (!cpfValido(cpf)) {
            alert('Informe um CPF valido.');
            form.cpf.focus();
            return false;
        }

        if (!senhaForte.test(senha)) {
            alert('A senha deve ter no minimo 6 caracteres, com 1 letra maiuscula, 1 minuscula, 1 numero e 1 caractere especial.');
            form.senha.focus();
            return false;
        }

        return true;
    }
</script>

<div class="navbar">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
</div>
<div class="page-body">
<form action="cadastrar.php" method="post" onsubmit="return validarForm()">
    <input type="text" name="nome" placeholder="Nome" required class="input">
    <input type="text" name="cpf" placeholder="CPF" required class="input">
    <input type="password" name="senha" placeholder="Senha" required class="input">
    <div style="display:flex; gap:10px; align-items:center; margin-top:4px;">
        <button type="submit" class="btn">Cadastrar</button>
        <a href="listarUsers.php" style="color:#6b7280; font-size:0.9rem;">Cancelar</a>
    </div>
</form>
</div>