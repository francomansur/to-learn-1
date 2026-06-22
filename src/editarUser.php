<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';

$cpf = $_GET['cpf'] ?? '';

$sql = "SELECT nome, cpf FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    header('Location: listarUsers.php');
    exit;
}
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
    .page-body { padding: 32px 28px; max-width: 560px; margin: 0 auto; }

    /* CARD */
    .card { background: #fff; border: 1px solid #E5EAF3; border-radius: 12px; padding: 32px; }
    .card-title { font-size: 1rem; font-weight: 700; color: #1A204C; border-left: 4px solid #FFC107; padding-left: 10px; margin-bottom: 6px; }
    .card-subtitle { font-size: 0.85rem; color: #6B89C3; margin-bottom: 24px; padding-left: 14px; }

    /* FORM */
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group label { font-size: 0.8rem; font-weight: 700; color: #6B89C3; text-transform: uppercase; letter-spacing: 0.05em; }
    .input { padding: 11px 14px; border: 1px solid #6B89C3; border-radius: 8px; font-size: 0.95rem; color: #1A204C; background: #fff; width: 100%; transition: border-color 0.2s, box-shadow 0.2s; }
    .input:focus { outline: none; border-color: #1A204C; box-shadow: 0 0 0 3px rgba(107,137,195,0.25); }
    .form-actions { display: flex; gap: 12px; align-items: center; margin-top: 8px; }

    /* BOTÕES */
    .btn { display: inline-flex; align-items: center; padding: 11px 24px; background: #FFC107; color: #1A204C; border: none; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 700; text-decoration: none; transition: filter 0.15s; }
    .btn:hover { filter: brightness(1.1); text-decoration: none; }
    .btn-ghost { background: transparent; color: #6B89C3; border: 1px solid #E5EAF3; font-weight: 600; }
    .btn-ghost:hover { background: #E5EAF3; filter: none; }
    /* ERRO DE VALIDAÇÃO */
    .input-error { border-color: #d64242 !important; box-shadow: 0 0 0 3px rgba(214,66,66,0.2) !important; }
    .error-hint  { font-size: 0.78rem; color: #d64242; margin-top: 4px; }
</style>

<script src="validacao.js" defer></script>

<div class="navbar">
    <span>Editar Usuário</span>
    <a href="listarUsers.php">← Voltar</a>
</div>

<div class="page-body">
    <div class="card">
        <h2 class="card-title">Editar Usuário</h2>
        <p class="card-subtitle">CPF atual: <?php echo htmlspecialchars($usuario['cpf']); ?></p>

        <form action="alterarUser.php" method="post" onsubmit="return validarEdicao(this)">
            <input type="hidden" name="cpf_original" value="<?php echo htmlspecialchars($usuario['cpf']); ?>">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input id="nome" type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" placeholder="Nome completo" required class="input">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input id="cpf" type="text" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" placeholder="000.000.000-00" required class="input">
            </div>

            <div class="form-group">
                <label for="senha">Nova Senha</label>
                <input id="senha" type="password" name="senha" placeholder="Deixe vazio para não alterar" class="input">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Salvar</button>
                <a href="listarUsers.php" class="btn btn-ghost">Cancelar</a>
            </div>

        </form>
    </div>
</div>
