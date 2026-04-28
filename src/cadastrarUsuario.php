<?php
include __DIR__ . '/../database/conexao.php';

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$cpfOriginal = trim($_POST['cpf_original'] ?? '');
$origem = trim($_POST['origem'] ?? 'publico');
$ehPainel = $cpfOriginal !== '' || $origem === 'painel';

if ($ehPainel) {
    require_once 'valida.php';
}

$destinoErro = $ehPainel ? 'inicial.php' : 'cadastro.php';
$destinoSucesso = $ehPainel ? 'inicial.php' : 'index.php';

if ($cpf === '') {
    header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Informe o CPF.'));
    exit;
}

if ($senha === '') {
    header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Informe a senha.'));
    exit;
}

if ($nome === '') {
    header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Informe o nome.'));
    exit;
}

if ($cpfOriginal !== '') {
    $sql = 'UPDATE usuarios SET cpf = ?, nome = ?, senha = ? WHERE cpf = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Erro ao preparar a edicao.'));
        exit;
    }

    $stmt->bind_param('ssss', $cpf, $nome, $senha, $cpfOriginal);
} else {
    $sql = 'INSERT INTO usuarios (nome, cpf, senha) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Erro ao preparar o cadastro.'));
        exit;
    }

    $stmt->bind_param('sss', $nome, $cpf, $senha);
}

if (!$stmt->execute()) {
    if ($stmt->errno === 1062) {
        header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('CPF ja cadastrado.'));
    } else {
        header('Location: ' . $destinoErro . '?status=0&msg=' . urlencode('Erro ao salvar usuario.'));
    }

    exit;
}

if ($ehPainel) {
    $msg = $cpfOriginal !== ''
        ? 'Usuario editado com sucesso.'
        : 'Usuario cadastrado com sucesso.';
} else {
    $msg = 'Cadastro realizado com sucesso. Agora faca o login.';
}

header('Location: ' . $destinoSucesso . '?status=1&msg=' . urlencode($msg));
exit;
