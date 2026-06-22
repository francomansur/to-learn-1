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
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #E5EAF3; }
        .login-box { background: #1A204C; padding: 36px 32px; border: 1px solid #6B89C3; border-radius: 14px; min-width: 300px; color: #fff; }
        .login-box h2 { margin: 0 0 24px; font-size: 1.5rem; font-weight: 700; color: #FFC107; }
        label { display: block; margin-bottom: 6px; font-size: 0.85rem; font-weight: 600; color: #6B89C3; text-transform: uppercase; letter-spacing: 0.05em; }
        .input { display: block; width: 100%; padding: 11px 14px; margin-bottom: 14px; border: 1px solid #6B89C3; border-radius: 8px; box-sizing: border-box; font-size: 0.98rem; background: #fff; color: #1A204C; transition: border-color 0.2s; }
        .input:focus { outline: none; border-color: #FFC107; }
        .btn { display: block; width: 100%; padding: 12px; background: #FFC107; color: #1A204C; border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; font-weight: 700; transition: filter 0.2s; }
        .btn:hover { filter: brightness(1.1); }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <?php if ($status === '0' && $msg !== ''): ?>
                <p style="color:#dc2626; font-size:0.85rem; margin:0 0 12px;"><?php echo htmlspecialchars($msg); ?></p>
            <?php endif; ?>
            <label>CPF</label>
            <input type="text" name="cpf" class="input">
            <label>Senha</label>
            <input type="password" name="senha" class="input">
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>

</html>