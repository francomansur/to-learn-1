<?php
$status = $_GET['status'] ?? '';
$msg = trim($_GET['msg'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">
            <h1 class="auth-title">Tec. Para internet</h1>
            <p class="auth-subtitle">Entre com seu CPF e senha para continuar.</p>

            <?php if ($msg !== '') { ?>
                <p class="feedback <?php echo $status === '1' ? 'success' : 'error'; ?>"><?php echo $msg; ?></p>
            <?php } ?>

            <form method="POST" action="login.php" class="form-grid">
                <div class="form-row">
                    <label for="cpf">CPF</label>
                    <input id="cpf" type="text" name="cpf" required>
                </div>

                <div class="form-row">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password" name="senha" required>
                </div>

                <div class="actions">
                    <button class="button button-primary" type="submit">Entrar</button>
                    <a class="link-button" href="cadastro.php">Cadastrar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>