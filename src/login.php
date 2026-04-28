<?php
include __DIR__ . '/../database/conexao.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if ($cpf === '') {
    header('Location: index.php?status=0&msg=' . urlencode('Informe o CPF.'));
    exit;
}

if ($senha === '') {
    header('Location: index.php?status=0&msg=' . urlencode('Informe a senha.'));
    exit;
}

$sql = "SELECT cpf, nome, senha FROM usuarios WHERE cpf = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header('Location: index.php?status=0&msg=' . urlencode('Erro interno ao processar login.'));
    exit;
}

$stmt->bind_param('ss', $cpf, $senha);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    header('Location: index.php?status=0&msg=' . urlencode('CPF ou senha incorretos.'));
    exit;
}

$_SESSION['cpf'] = $usuario['cpf'];
$_SESSION['nome'] = $usuario['nome'];

header('Location: inicial.php');
exit;
