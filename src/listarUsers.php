<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$sql = "select nome, cpf from usuarios";
$result = $conn->query($sql);
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div>
        <a href="cadastrarUser.php">Cadastrar</a>
        <a href="logout.php">Sair</a>
    </div>
</div>

<table style="margin-top: 48px;">
    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['nome']); ?></td>
        <td><?php echo htmlspecialchars($row['cpf']); ?></td>
        <td>
            <a href="editarUser.php?cpf=<?php echo urlencode($row['cpf']); ?>">Editar</a>
            <a href="apagarUser.php?cpf=<?php echo urlencode($row['cpf']); ?>" onclick="return confirm('Apagar usuário?')">Apagar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
