<?php
//include('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>CRUD usuário</h1>

    inserir
    <form action='post' action="\bruno\crud\insereAlunos.php">
        Nome: <input type="text" name="nome" placeholder="Digite o nome do usuário"><br>
        CPF: <input type="text" name="cpf" placeholder="Digite o cpf do usuário"><br>
        Senha: <input type="password" name="senha" placeholder="Digite a senha do usuário"><br>
        <input type="submit" value="enviar">
    </form>

    <div id="resultados">

    </div>

</body>

</html>