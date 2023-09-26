<?php
session_start();
include('conexao.php');

$id_usuario = $_SESSION['id_usuario'];


$query_grupo = "SELECT id_usuario FROM usuario WHERE id_usuario = $id_usuario LIMIT 1";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

if ($result_grupo->rowCount() != 0) {
 
  $query_delete_usuario = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
  $result_delete_usuario = $conn->prepare($query_delete_usuario);
  $result_delete_usuario->execute();

  $_SESSION['msg_perfil_excluido'] = "<p>Erro: Conta excluída com sucesso.</p>";
  header('Location: logout.php');
  exit();
} else {
  $_SESSION['msg_perfil_excluido'] = "<p>Erro: Conta não encontrada.</p>";
  header("Location: perfil.php?id_usuario=$_SESSION[id_usuario]");
  exit();
}

?>