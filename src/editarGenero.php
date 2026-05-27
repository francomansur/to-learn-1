<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$genero = $_GET['id'] ?? '';

$sql = "select descricao, genero from genero where genero = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $genero);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();


?>

<style>
    * { font-family: sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f5f5f5; }
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background: #fff; border-bottom: 1px solid #ddd; }
    .navbar a { color: #000000; text-decoration: none; margin-left: 12px; font-size: 0.9rem; }
    .navbar a:hover { text-decoration: underline; }
    .page-body { padding: 24px; }
    .input { display: block; margin-bottom: 8px; padding: 8px; width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 4px; }
    .btn { display: inline-block; padding: 8px 20px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 0.95rem; }
    .btn:hover { background: #1d4ed8; }
</style>
<div class="navbar">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="inicial.php">Voltar</a></div>
</div>
<div class="page-body">
<form action="alterarGenero.php" method="post">
    <input type="hidden" name="genero" value="<?php echo htmlspecialchars($usuario['genero']); ?>">
    <input type="text" name="descricao" placeholder="Descrição" value="<?php echo htmlspecialchars($usuario['descricao']); ?>" required class="input">
    <div style="display:flex; gap:10px; align-items:center; margin-top:8px;">
        <button type="submit" class="btn">Salvar</button>
        <a href="genero.php" style="color:#6b7280; font-size:0.9rem;">Cancelar</a>
    </div>
</form>
</div>
