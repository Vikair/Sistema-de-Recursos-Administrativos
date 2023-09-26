<?php
include('conexao.php');
session_start();
//INCLUIR
$nome = isset($_POST['nome'])? $_POST['nome'] : '';
$email = isset($_POST['email'])? $_POST['email'] : ''; 
$senha = isset($_POST['senha'])? $_POST['senha'] : '';

$verificar_email ="SELECT email FROM usuario WHERE email  = '$email'"; //Percorre todo a coluna matricula e ver se a matricula que o usuário informou já existe
$query_verificar = mysqli_query($conexao, $verificar_email);
$dados = mysqli_fetch_row($query_verificar);


if ($dados[0] != $email) { 

$incluir = "INSERT INTO usuario(nome, email, senha) 
VALUES ('$nome', '$email', '$senha')";
$query_incluir = mysqli_query($conexao, $incluir);


$_SESSION['msg_cadastro'] = "<h3 class='success'>Email cadastrado com sucesso.</h3>";
header('location: cadastro.php');
exit();
} else {

$_SESSION['msg_cadastro'] = "<p class='error'>Email já existe</p>";
header("location: cadastro.php");
exit();
}

?>
