<?php
include __DIR__ . '/../database/conexao.php';

$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';
$nome = $_POST['nome'] ?? '';

try {
    $sql = "insert into usuarios (nome, cpf, senha) values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $cpf, $senha);
    if ($stmt->execute()) {
        header('Location: cadastrarUser.php');
    } else {
        echo "Ocorreu um erro ao cadastrar o usuário";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}