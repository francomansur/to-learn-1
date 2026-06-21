<?php
include __DIR__ . '/../database/conexao.php';

$genero = $_GET['genero'] ?? '';

try {
    $sql = "delete from genero where genero = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $genero);

    if ($stmt->execute()) {
        header('Location: genero.php');
    } else {
        echo "Ocorreu um erro ao apagar o usuário.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}