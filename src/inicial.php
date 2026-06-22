<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$usuarios = $conn->query("SELECT cpf, nome, senha FROM usuarios");
$filmes   = $conn->query("SELECT f.nome AS titulo, f.ano, g.descricao AS genero
                          FROM filmes f
                          JOIN genero g ON f.genero = g.genero
                          ORDER BY f.nome ASC");
?>

<style>
    * { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
    body { background: #F4F4F4; }

    /* NAVBAR */
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 28px; background: #1A204C; border-bottom: 3px solid #FFC107; }
    .navbar span { color: #fff; font-weight: 600; }
    .navbar nav { display: flex; gap: 24px; align-items: center; }
    .navbar a { color: #fff; text-decoration: none; font-size: 0.9rem; opacity: 0.85; transition: color 0.2s; }
    .navbar a:hover { color: #FFC107; opacity: 1; }
    .navbar a.sair { color: #FFC107; opacity: 1; }

    /* PAGE */
    .page-body { padding: 32px 28px; max-width: 1000px; margin: 0 auto; display: flex; flex-direction: column; gap: 28px; }

    /* HERO */
    .hero { background: #1A204C; border-radius: 12px; padding: 32px 36px; color: #fff; }
    .hero h1 { font-size: 1.8rem; font-weight: 800; color: #FFC107; margin-bottom: 8px; }
    .hero p { font-size: 1rem; color: #E5EAF3; line-height: 1.6; }

    /* CARD */
    .card { background: #fff; border: 1px solid #E5EAF3; border-radius: 12px; padding: 28px; }
    .card-title { font-size: 1rem; font-weight: 700; color: #1A204C; border-left: 4px solid #FFC107; padding-left: 10px; margin-bottom: 20px; }

    /* TABELA */
    .table-wrap { overflow-x: auto; border-radius: 10px; border: 1px solid #E5EAF3; }
    table { border-collapse: collapse; width: 100%; background: #fff; }
    thead { background: #1A204C; color: #fff; }
    th { padding: 12px 16px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; text-align: left; }
    td { padding: 12px 16px; border-bottom: 1px solid #E5EAF3; color: #1A204C; vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: #E5EAF3; }
    .empty { text-align: center; color: #6B89C3; padding: 24px; }

    /* AÇÕES */
    .td-actions { display: flex; gap: 8px; }
    .table-action { font-size: 0.82rem; font-weight: 700; text-decoration: none; padding: 6px 14px; border-radius: 6px; }
    .table-action.edit   { background: #E5EAF3; color: #1A204C; }
    .table-action.edit:hover   { background: #6B89C3; color: #fff; }
    .table-action.delete { background: #fdecea; color: #d64242; }
    .table-action.delete:hover { background: #d64242; color: #fff; }
</style>

<div class="navbar">
    <span>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</span>
    <nav>
        <a href="filmes.php">Filmes</a>
        <a href="genero.php">Gêneros</a>
        <a href="listarUsers.php">Usuários</a>
        <a href="logout.php" class="sair">Sair</a>
    </nav>
</div>

<div class="page-body">

    <!-- HERO -->
    <div class="hero">
        <h1>Home</h1>
        <p>Cadastre ou edite seus filmes, gêneros e usuários do sistema.</p>
    </div>

    <!-- CARD: Listagem de Usuários -->
    <div class="card">
        <h2 class="card-title">Listagem de Usuários</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($usuarios && $usuarios->num_rows > 0): ?>
                    <?php while ($usuario = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['senha']); ?></td>
                        <td>
                            <div class="td-actions">
                                <a class="table-action edit"   href="inicial.php?editar=<?php echo urlencode($usuario['cpf']); ?>">Alterar</a>
                                <a class="table-action delete" href="apagarUsuario.php?cpf=<?php echo urlencode($usuario['cpf']); ?>" onclick="return confirm('Apagar usuário?')">Apagar</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="empty">Nenhum usuário encontrado.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CARD: Listagem de Filmes -->
    <div class="card">
        <h2 class="card-title">Listagem de Filmes</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Ano</th>
                        <th>Gênero</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($filmes && $filmes->num_rows > 0): ?>
                    <?php while ($filme = $filmes->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($filme['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($filme['ano']); ?></td>
                        <td><?php echo htmlspecialchars($filme['genero']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="empty">Nenhum filme cadastrado.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>