<?php
include __DIR__ . '/../database/conexao.php';

$descricao = $_POST['descricao'] ?? '';

try {
    $sql = "insert into genero (descricao) values (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $descricao);
    if ($stmt->execute()) {
        header('Location: genero.php');
    } else {
        echo "Ocorreu um erro ao cadastrar o gênero";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}