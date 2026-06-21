<?php
include __DIR__ . '/../database/conexao.php';

$nome = $_POST['nome'] ?? '';
$ano = $_POST['ano'] ?? '';
$genero = $_POST['genero'] ?? '';

if (empty($nome) || empty($ano) || empty($genero)) {
    echo "Todos os campos são obrigatórios.";
    exit;
}

try {
    $sql = "insert into filmes (nome, ano, genero) values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nome, $ano, $genero);
    if ($stmt->execute()) {
        header('Location: filmes.php');
    } else {
        echo "Ocorreu um erro ao cadastrar o filme";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}