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
    form { margin: 10px; }
</style>

<div class="navbar">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="inicial.php">Voltar</a></div>
</div>
<div class="page-body">
<form action="cadastrarFilme.php" method="post" onsubmit="return validarForm(this)">
    <input type="text" name="nome" placeholder="Nome" required class="input">
    <input type="number" name="ano" placeholder="Ano" required class="input" min="1900" max="<?php echo date('Y'); ?>">
    <select name="genero" required class="input">
        <option value="">Selecione um gênero</option>
        <?php
        $sqlGenero = "select * from genero";
        $resultGenero = $conn->query($sqlGenero);
        while ($rowGenero = $resultGenero->fetch_assoc()):
        ?>
        <option value="<?php echo htmlspecialchars($rowGenero['genero']); ?>">
            <?php echo htmlspecialchars($rowGenero['descricao']); ?>
        </option>
        <?php endwhile; ?>
    </select>
    <div style="display:flex; gap:10px; align-items:center; margin-top:4px;">
        <button type="submit" class="btn">Cadastrar</button>
    </div>
</form>
</div>
<?php
$sql = "select * from filmes f
        join genero g on f.genero = g.genero";
$result = $conn->query($sql);
?>
<?php while ($row = $result->fetch_assoc()): ?>
<form action="alterarFilme.php" method="post" onsubmit="return validarForm(this)">
    <input type="hidden" name="filme" value="<?php echo htmlspecialchars((string) $row['filme']); ?>">
    <input type="text" value="<?php echo htmlspecialchars($row['nome']); ?>" class="input" name="nome" required>
    <input type="number" value="<?php echo htmlspecialchars((string) $row['ano']); ?>" class="input" name="ano" required min="1900" max="<?php echo date('Y'); ?>">
    <select name="genero" required class="input">
        <option value="">Selecione um gênero</option>
        <?php
        $sqlGenero = "select * from genero";
        $resultGenero = $conn->query($sqlGenero);
        while ($rowGenero = $resultGenero->fetch_assoc()):
        ?>
        <option value="<?php echo htmlspecialchars($rowGenero['genero']); ?>" <?php if ($rowGenero['genero'] == $row['genero']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($rowGenero['descricao']); ?>
        </option>
        <?php endwhile; ?>
    </select>
    <button type="submit" class="btn">Alterar</button>
    <a href="apagarFilme.php?filme=<?php echo urlencode($row['filme']); ?>" class="btn btn-danger" onclick="return confirm('Apagar filme?')">Apagar</a>
    <br>
    </form>
    <?php endwhile; ?>
