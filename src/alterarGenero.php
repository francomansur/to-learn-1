<?php
include __DIR__ . '/../database/conexao.php';

$descricao = $_POST['descricao'] ?? '';
$genero = $_POST['genero'] ?? '';

try {
    if (!empty($descricao)) {
        $sql = "update genero set descricao = ? where genero = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $descricao, $genero);
    } else {
        $sql = "update genero set descricao = ? where genero = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $descricao, $genero);
    }

    if ($stmt->execute()) {
        header('Location: genero.php');
    } else {
        echo "Ocorreu um erro ao alterar o gênero.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}
