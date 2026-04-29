<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f5f5f5; }
        .login-box { background: #fff; padding: 32px; border: 1px solid #ddd; border-radius: 6px; min-width: 280px; }
        .login-box h2 { margin: 0 0 20px; font-size: 1.2rem; }
        label { display: block; margin-bottom: 4px; font-size: 0.9rem; }
        .input { display: block; width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { display: block; width: 100%; padding: 9px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label>CPF</label>
            <input type="text" name="cpf" class="input">
            <label>Senha</label>
            <input type="password" name="senha" class="input">
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>

</html>