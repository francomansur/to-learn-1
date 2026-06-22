<?php
require_once 'valida.php';
include __DIR__ . '/../database/conexao.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
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
    .page-body { padding: 32px 28px; max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 28px; }

    /* CARD */
    .card { background: #fff; border: 1px solid #E5EAF3; border-radius: 12px; padding: 28px; }
    .card-title { font-size: 1rem; font-weight: 700; color: #1A204C; border-left: 4px solid #FFC107; padding-left: 10px; margin-bottom: 20px; }

    /* FORM */
    .form-row { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
    .input { padding: 10px 14px; border: 1px solid #6B89C3; border-radius: 8px; font-size: 0.95rem; color: #1A204C; background: #fff; transition: border-color 0.2s, box-shadow 0.2s; }
    .input:focus { outline: none; border-color: #1A204C; box-shadow: 0 0 0 3px rgba(107,137,195,0.25); }
    .input-nome { flex: 2; min-width: 160px; }
    .input-ano  { flex: 1; min-width: 90px; }
    .input-sel  { flex: 2; min-width: 160px; }

    /* BOTÕES */
    .btn { display: inline-flex; align-items: center; padding: 10px 22px; background: #FFC107; color: #1A204C; border: none; border-radius: 8px; cursor: pointer; font-size: 0.88rem; font-weight: 700; text-decoration: none; transition: filter 0.15s; white-space: nowrap; }
    .btn:hover { filter: brightness(1.1); }
    .btn-danger { background: #d64242; color: #fff; }
    .btn-danger:hover { background: #b91c1c; filter: none; }
    .btn-sm { padding: 7px 16px; font-size: 0.82rem; }

    /* TABELA */
    .table-wrap { overflow-x: auto; border-radius: 10px; border: 1px solid #E5EAF3; }
    table { border-collapse: collapse; width: 100%; background: #fff; }
    thead { background: #1A204C; color: #fff; }
    th { padding: 12px 16px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; text-align: left; }
    td { padding: 10px 16px; border-bottom: 1px solid #E5EAF3; color: #1A204C; vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: #E5EAF3; }
    .td-actions { display: flex; gap: 8px; align-items: center; }
    .td-input { width: 100%; }
</style>

<script>
    function cpfValido(cpf) { return true; } /* placeholder — validação real no cadastrarUser */

    function validarForm(form) {
        const ano = parseInt(form.ano.value, 10);
        const anoAtual = new Date().getFullYear();
        if (!form.nome.value.trim()) {
            alert('Informe o nome do filme.');
            form.nome.focus();
            return false;
        }
        if (isNaN(ano) || ano < 1900 || ano > anoAtual) {
            alert('Informe um ano válido entre 1900 e ' + anoAtual + '.');
            form.ano.focus();
            return false;
        }
        if (!form.genero.value) {
            alert('Selecione um gênero.');
            form.genero.focus();
            return false;
        }
        return true;
    }
</script>

<div class="navbar">
    <span>Filmes</span>
    <a href="inicial.php">← Voltar</a>
</div>

<div class="page-body">

    <!-- CARD: Cadastrar Filme -->
    <div class="card">
        <h2 class="card-title">Cadastrar Filme</h2>
        <form action="cadastrarFilme.php" method="post" onsubmit="return validarForm(this)">
            <div class="form-row">
                <input type="text" name="nome" placeholder="Nome do filme" required class="input input-nome">
                <input type="number" name="ano" placeholder="Ano" required class="input input-ano" min="1900" max="<?php echo date('Y'); ?>">
                <select name="genero" required class="input input-sel">
                    <option value="">Selecione um gênero</option>
                    <?php
                    $sqlGenero = "SELECT * FROM genero";
                    $resultGenero = $conn->query($sqlGenero);
                    while ($rowGenero = $resultGenero->fetch_assoc()):
                    ?>
                    <option value="<?php echo htmlspecialchars($rowGenero['genero']); ?>">
                        <?php echo htmlspecialchars($rowGenero['descricao']); ?>
                    </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="btn">Cadastrar</button>
            </div>
        </form>
    </div>

    <!-- CARD: Listagem de Filmes -->
    <div class="card">
        <h2 class="card-title">Filmes Cadastrados</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ano</th>
                        <th>Gênero</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT f.*, g.descricao AS genero_nome FROM filmes f
                        JOIN genero g ON f.genero = g.genero";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <form action="alterarFilme.php" method="post" onsubmit="return validarForm(this)">
                            <input type="hidden" name="filme" value="<?php echo htmlspecialchars((string) $row['filme']); ?>">
                            <td><input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required class="input td-input"></td>
                            <td><input type="number" name="ano" value="<?php echo htmlspecialchars((string) $row['ano']); ?>" required class="input" style="width:90px;" min="1900" max="<?php echo date('Y'); ?>"></td>
                            <td>
                                <select name="genero" required class="input td-input">
                                    <option value="">Selecione</option>
                                    <?php
                                    $sqlG2 = "SELECT * FROM genero";
                                    $resG2 = $conn->query($sqlG2);
                                    while ($g = $resG2->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo htmlspecialchars($g['genero']); ?>" <?php if ($g['genero'] == $row['genero']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($g['descricao']); ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                            <td>
                                <div class="td-actions">
                                    <button type="submit" class="btn btn-sm">Salvar</button>
                                    <a href="apagarFilme.php?filme=<?php echo urlencode($row['filme']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apagar filme?')">Apagar</a>
                                </div>
                            </td>
                        </form>
                    </tr>
                <?php
                    endwhile;
                else:
                ?>
                    <tr><td colspan="4" style="text-align:center; color:#6B89C3; padding: 24px;">Nenhum filme cadastrado.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
