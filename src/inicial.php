<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';

$nome = $_SESSION['nome'] ?? '';
$status = $_GET['status'] ?? '';
$msg = trim($_GET['msg'] ?? '');

$cpfEdicao = trim($_GET['editar'] ?? '');
$usuarioEdicao = [
    'cpf' => '',
    'nome' => '',
    'senha' => '',
];

if ($cpfEdicao !== '') {
    $sqlEdicao = 'SELECT cpf, nome, senha FROM usuarios WHERE cpf = ?';
    $stmtEdicao = $conn->prepare($sqlEdicao);

    if ($stmtEdicao) {
        $stmtEdicao->bind_param('s', $cpfEdicao);
        $stmtEdicao->execute();
        $resultadoEdicao = $stmtEdicao->get_result();
        $registroEdicao = $resultadoEdicao->fetch_assoc();

        if ($registroEdicao) {
            $usuarioEdicao = $registroEdicao;
        }
    }
}

$modoEdicao = $usuarioEdicao['cpf'] !== '';
$sql = 'SELECT cpf, nome, senha FROM usuarios ORDER BY nome';
$stmt = $conn->prepare($sql);
$usuarios = false;

if ($stmt) {
    $stmt->execute();
    $usuarios = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="page">
        <div class="topbar">
            <div>
                Olá <?php echo $nome; ?>
            </div>
            <div>
                <a class="link-button" href="logout.php">Logout</a>
            </div>
        </div>

        <div class="layout">
            <div class="sidebar">
                <h2>Menu</h2>
                <a class="table-action" href="inicial.php">Cadastrar Usuário</a>
            </div>

            <div class="content">
                <?php if ($msg !== '') { ?>
                    <p class="feedback <?php echo $status === '1' ? 'success' : 'error'; ?>"><?php echo $msg; ?></p>
                <?php } ?>

                <div class="card card-center">
                    <h2><?php echo $modoEdicao ? 'Editar Usuário' : 'Cadastro de Usuários'; ?></h2>

                    <form method="post" action="cadastrarUsuario.php" class="form-grid">
                        <input type="hidden" name="cpf_original" value="<?php echo $usuarioEdicao['cpf']; ?>">
                        <input type="hidden" name="origem" value="painel">

                        <div class="form-row">
                            <label for="cpf">CPF</label>
                            <input id="cpf" type="text" name="cpf" value="<?php echo $usuarioEdicao['cpf']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" value="<?php echo $usuarioEdicao['nome']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="senha">Senha</label>
                            <input id="senha" type="text" name="senha" value="<?php echo $usuarioEdicao['senha']; ?>" required>
                        </div>

                        <div class="actions">
                            <button class="button button-primary" type="submit"><?php echo $modoEdicao ? 'Salvar Alterações' : 'Inserir'; ?></button>
                            <?php if ($modoEdicao) { ?>
                                <a class="link-button" href="inicial.php">Cancelar</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <h2>Listagem de Usuários</h2>

                    <div class="table-wrapper">
                        <table>
                            <tr>
                                <th>CPF</th>
                                <th>NOME</th>
                                <th>SENHA</th>
                                <th>ALTERAR</th>
                                <th>APAGAR</th>
                            </tr>
                            <?php if ($usuarios && $usuarios->num_rows > 0) { ?>
                                <?php while ($usuario = $usuarios->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $usuario['cpf']; ?></td>
                                        <td><?php echo $usuario['nome']; ?></td>
                                        <td><?php echo $usuario['senha']; ?></td>
                                        <td><a class="table-action" href="inicial.php?editar=<?php echo urlencode($usuario['cpf']); ?>">ALTERAR</a></td>
                                        <td><a class="table-action delete" href="apagarUsuario.php?cpf=<?php echo urlencode($usuario['cpf']); ?>">APAGAR</a></td>
                                    </tr>
                                <?php } ?>
                            <?php } elseif ($usuarios) { ?>
                                <tr>
                                    <td colspan="5">Nenhum usuário encontrado</td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5">Erro na SQL: <?php echo $conn->error; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>