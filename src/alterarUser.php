<?php
include __DIR__ . '/../database/conexao.php';

$cpf_original = $_POST['cpf_original'] ?? '';
$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';

try {
    if (!empty($senha)) {
        $sql = "update usuarios set nome = ?, cpf = ?, senha = ? where cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $cpf, $senha, $cpf_original);
    } else {
        $sql = "update usuarios set nome = ?, cpf = ? where cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $cpf, $cpf_original);
    }

    if ($stmt->execute()) {
        header('Location: listarUsers.php');
    } else {
        echo "Ocorreu um erro ao alterar o usuário.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}
