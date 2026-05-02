<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';

$cpf = trim($_GET['cpf'] ?? '');

if ($cpf === '') {
    header('Location: inicial.php?status=0&msg=' . urlencode('Informe o CPF do usuario para apagar.'));
    exit;
}

$sql = 'DELETE FROM usuarios WHERE cpf = ?';
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header('Location: inicial.php?status=0&msg=' . urlencode('Erro ao preparar a exclusao.'));
    exit;
}

$stmt->bind_param('s', $cpf);

if (!$stmt->execute()) {
    header('Location: inicial.php?status=0&msg=' . urlencode('Erro ao apagar usuario.'));
    exit;
}

header('Location: inicial.php?status=1&msg=' . urlencode('Usuario apagado com sucesso.'));
exit;
