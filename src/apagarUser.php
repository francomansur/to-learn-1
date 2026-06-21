<?php
include __DIR__ . '/../database/conexao.php';

$cpf = $_GET['cpf'] ?? '';

try {
    $sql = "delete from usuarios where cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);

    if ($stmt->execute()) {
        header('Location: listarUsers.php');
    } else {
        echo "Ocorreu um erro ao apagar o usuário.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}
