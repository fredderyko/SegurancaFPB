<?php


session_start();

include('conexao.php');
include('funcoes.php');

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf']: '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$selectcpf = "select cpf from usuario WhERE cpf= '$cpf'";
$querycpf = mysqli_query($conexao,$selectcpf);
$dadocpf = mysqli_fetch_row($querycpf);

$selectlogin = "select login from login WhERE login = '$login'";
$querylogin = mysqli_query($conexao,$selectlogin);
$dadologin = mysqli_fetch_row($querylogin);

if($nome <> NULL) {
    if(($dadocpf == NULL)&&($dadologin == NULL)){

        $insertusuario = "INSERT INTO usuario (nome, cpf, telefone)
        VALUES('$nome','$cpf', '$telefone')";
        $queryusuario = mysqli_query($conexao, $insertusuario);
        
        $senhacriptografada = criptografar($senha);
        $insertlogin = "INSERT INTO login(cpf, login, senha, nivel)
        VALUES('$cpf','$login','$senhacriptografada', 3)";
        $querylogin = mysqli_query($conexao,$insertlogin);

        echo '<script>alert("Usuario Cadastrado");
			window.location="adicionar.php";
			</script>';


}else{
    echo '<script>alert("CPF e/ou LOGIN em uso");
			window.location="adicionar.php";
			</script>';
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h1> Adicionar usuario </h1>
        <form id="form-add" action="#" method="POST">
        nome: <input type="text" name="nome"><br>
        cpf: <input type="text" name="cpf"><br>
        telefone: <input type="text" name="telefone"><br>
        login: <input type="text" name="login"><br>
        senha: <input type="password" name="senha"><br>
        <input type="submit" name="cadastrar" value="cadastrar">
</center>
</body>
</html>