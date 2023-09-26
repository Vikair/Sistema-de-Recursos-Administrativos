<?php
if (!isset($_SESSION)) {
  session_start();
}
include('conexao.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = isset($_POST['nome_grupo']) ? $_POST['nome_grupo'] : '';
$desc_grupo = isset($_POST['desc_grupo']) ? $_POST['desc_grupo'] : '';
$id_usuario_criador = $_SESSION['id_usuario'];

$incluir = "INSERT INTO grupo (nome_grupo, desc_grupo, usuario_id, id_usuario_criador) 
            VALUES (?, ?, ?, ?)";
$stmt = $conexao->prepare($incluir);
$stmt->bind_param("ssii", $nome_grupo, $desc_grupo, $_SESSION['id_usuario'], $id_usuario_criador);
$stmt->execute();

// Atualizar a coluna adm para o usuário criador
$atualizar_adm = "UPDATE usuario SET adm = 1 WHERE id_usuario = ?";
$stmt_adm = $conexao->prepare($atualizar_adm);
$stmt_adm->bind_param("i", $id_usuario_criador);
$stmt_adm->execute();

header("location: principal.php");
?>