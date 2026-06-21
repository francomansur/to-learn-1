<?php
require_once 'valida.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
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