<?php
$dados = new stdClass;

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$nome = $_post['nome'];

$dados->cpf = $cpf;
$dados->senha = $senha;

var_dump($dados);

if(empty($dados->cpf) || empty($dados->senha)){
    echo 'Preencha todos os dados!';
}else{
    $_SESSION['nome'] = $nome;
}
?>