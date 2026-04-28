<?php
$status = $_GET['status'] ?? '';
$msg = trim($_GET['msg'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">
            <h1 class="auth-title">Criar Conta</h1>
            <p class="auth-subtitle">Preencha os dados para cadastrar um novo usuario.</p>

            <?php if ($msg !== '') { ?>
                <p class="feedback <?php echo $status === '1' ? 'success' : 'error'; ?>"><?php echo $msg; ?></p>
            <?php } ?>

            <form method="POST" action="cadastrarUsuario.php" class="form-grid">
                <input type="hidden" name="origem" value="publico">

                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" required>
                </div>

                <div class="form-row">
                    <label for="cpf">CPF</label>
                    <input id="cpf" type="text" name="cpf" required>
                </div>

                <div class="form-row">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password" name="senha" required>
                </div>

                <div class="actions">
                    <button class="button button-primary" type="submit">Cadastrar</button>
                    <a class="link-button" href="index.php">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>