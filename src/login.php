<?
include __DIR__ . '/../database/conexao.php';

$dados = new stdClass;

$dados->cpf = $_POST['cpf'] ?? '';
$dados->senha = $_POST['senha'] ?? '';

try {
    $sql = "SELECT * FROM usuarios WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $dados->cpf, $dados->senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['USUARIO'] = $result->fetch_assoc()['nome'];
        header('Location: listarUsers.php');
    } else {
        echo "login ou senha incorretos";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    exit;
}

