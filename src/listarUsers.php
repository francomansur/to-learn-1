<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$sql = "SELECT nome, cpf FROM usuarios";
$result = $conn->query($sql);
?>

<style>
    * { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
    body { background: #F4F4F4; }

    /* NAVBAR */
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 28px; background: #1A204C; border-bottom: 3px solid #FFC107; }
    .navbar span { color: #fff; font-weight: 600; font-size: 1rem; }
    .navbar a { color: #fff; text-decoration: none; font-size: 0.9rem; opacity: 0.85; transition: color 0.2s; }
    .navbar a:hover { color: #FFC107; opacity: 1; }

    /* PAGE */
    .page-body { padding: 32px 28px; max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 28px; }

    /* CARD */
    .card { background: #fff; border: 1px solid #E5EAF3; border-radius: 12px; padding: 28px; }
    .card-title { font-size: 1rem; font-weight: 700; color: #1A204C; border-left: 4px solid #FFC107; padding-left: 10px; margin-bottom: 20px; }
    .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .card-header .card-title { margin-bottom: 0; }

    /* BOTÕES */
    .btn { display: inline-flex; align-items: center; padding: 10px 22px; background: #FFC107; color: #1A204C; border: none; border-radius: 8px; cursor: pointer; font-size: 0.88rem; font-weight: 700; text-decoration: none; transition: filter 0.15s; white-space: nowrap; }
    .btn:hover { filter: brightness(1.1); text-decoration: none; }
    .btn-danger { background: #d64242; color: #fff; }
    .btn-danger:hover { background: #b91c1c; filter: none; }
    .btn-sm { padding: 7px 16px; font-size: 0.82rem; }

    /* TABELA */
    .table-wrap { overflow-x: auto; border-radius: 10px; border: 1px solid #E5EAF3; }
    table { border-collapse: collapse; width: 100%; background: #fff; }
    thead { background: #1A204C; color: #fff; }
    th { padding: 12px 16px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; text-align: left; }
    td { padding: 12px 16px; border-bottom: 1px solid #E5EAF3; color: #1A204C; vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: #E5EAF3; }
    .td-actions { display: flex; gap: 8px; align-items: center; }
</style>

<div class="navbar">
    <span>Usuários</span>
    <a href="inicial.php">← Voltar</a>
</div>

<div class="page-body">

    <!-- CARD: Listagem de Usuários -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Usuários Cadastrados</h2>
            <a href="cadastrarUser.php" class="btn">+ Novo Usuário</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                        <td>
                            <div class="td-actions">
                                <a href="editarUser.php?cpf=<?php echo urlencode($row['cpf']); ?>" class="btn btn-sm">Editar</a>
                                <a href="apagarUser.php?cpf=<?php echo urlencode($row['cpf']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apagar usuário?')">Apagar</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center; color:#6B89C3; padding: 24px;">Nenhum usuário cadastrado.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
