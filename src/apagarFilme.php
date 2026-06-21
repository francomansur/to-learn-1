<?php
include __DIR__ . '/../database/conexao.php';

$filme = $_GET['filme'] ?? '';

try {
    $sql = "delete from filmes where filme = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $filme);

    if ($stmt->execute()) {
        header('Location: filmes.php');
    } else {
        echo "Ocorreu um erro ao apagar o filme.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}