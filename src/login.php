<?
header('Content-Type: application/json');

include __DIR__ . '/../database/conexao.php';

$dados = new stdClass;

$dados->cpf = $_POST['cpf'];
$dados->senha = $_POST['senha'];

try {

    if (empty($dados->cpf)) {
        throw new Exception('Informe o CPF.');
    }

    if (empty($dados->senha)) {
        throw new Exception('Informe a senha.');
    }
} catch (Exception $e) {
    echo json_encode(['erro' => $e->getMessage()]);
    exit;
}

header('Location: inicial.php');
