<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<style>
    * { font-family: sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f5f5f5; }
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background: #fff; border-bottom: 1px solid #ddd; }
    .navbar a { color: rgb(0, 0, 0); text-decoration: none; margin-left: 12px; font-size: 0.9rem; }
    .navbar a:hover { text-decoration: underline; }
    .page-body { padding: 24px; }
    .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 0.85rem; text-decoration: none; }
    .btn:hover { background: #1d4ed8; }
    .btn-danger { background: #dc2626; }
    .btn-danger:hover { background: #b91c1c; }
    table { border-collapse: collapse; width: 100%; background: #fff; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px 14px; text-align: left; }
    th { background: #f0f0f0; font-weight: 600; }
    tr:hover td { background: #f9f9f9; }
</style>

<div class="navbar">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="inicial.php">Voltar</a></div>
</div>
<div class="page-body">
<form action="cadastrarGenero.php" method="post">
    <input type="text" name="descricao" placeholder="Descrição" required class="input">
    <div style="display:flex; gap:10px; align-items:center; margin-top:4px;">
        <button type="submit" class="btn">Cadastrar</button>
    </div>
</form>
</div>
<?php
$sql = "select * from genero";
$result = $conn->query($sql);
?>
<table>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['descricao']); ?></td>
        <td style="display: flex; gap: 8px;">
            <a href="editarGenero.php?genero=<?php echo urlencode($row['genero']); ?>" class="btn">Editar</a>
            <a href="apagarGenero.php?genero=<?php echo urlencode($row['genero']); ?>" class="btn btn-danger" onclick="return confirm('Apagar gênero?')">Apagar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>