<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$cpf = $_GET['cpf'] ?? '';

$sql = "select nome, cpf from usuarios where cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
</div>

<form action="alterarUser.php" method="post" style="margin-top: 48px;">
    <input type="hidden" name="cpf_original" value="<?php echo htmlspecialchars($usuario['cpf']); ?>">
    <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required class="input"><br>
    <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required class="input"><br>
    <input type="password" name="senha" placeholder="Nova senha (deixe vazio para não alterar)" class="input"><br>
    <button type="submit" style="margin-top: 8px;">Salvar</button>
    <a href="listarUsers.php">Cancelar</a>
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
