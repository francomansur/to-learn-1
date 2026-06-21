<?php
include __DIR__ . '/../database/conexao.php';

$filme = $_POST['filme'] ?? '';
$nome = $_POST['nome'] ?? '';
$ano = $_POST['ano'] ?? '';
$genero = $_POST['genero'] ?? '';

if (empty($filme) || empty($nome) || empty($ano) || empty($genero)) {
    echo "Todos os campos são obrigatórios.";
    exit;
}

try {
    
    $sql = "update filmes set nome = ?, ano = ?, genero = ? where filme = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nome, $ano, $genero, $filme);

    if ($stmt->execute()) {
        header('Location: filmes.php');
    } else {
        echo "Ocorreu um erro ao alterar o filme.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}
