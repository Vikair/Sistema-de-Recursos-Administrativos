<?php
session_start();
include('conexao.php');

$id_grupo = $_GET['id_grupo'];


$query_grupo = "SELECT id_grupo FROM grupo WHERE id_grupo = $id_grupo LIMIT 1";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

if ($result_grupo->rowCount() != 0) {

  $query_delete_tarefas = "DELETE FROM tarefa WHERE grupo_id = $id_grupo";
  $result_delete_tarefas = $conn->prepare($query_delete_tarefas);
  $result_delete_tarefas->execute();


  $query_delete_colaborador_grupo = "DELETE FROM colaborador_grupo WHERE grupo_id = $id_grupo";
  $result_delete_colaborador_grupo = $conn->prepare($query_delete_colaborador_grupo);
  $result_delete_colaborador_grupo->execute();

 
  $query_delete_grupo = "DELETE FROM grupo WHERE id_grupo = $id_grupo";
  $result_delete_grupo = $conn->prepare($query_delete_grupo);
  $result_delete_grupo->execute();

  $_SESSION['msg'] = "<p>O grupo foi excluído com sucesso.</p>";
  header('Location: principal.php');
  exit();
} else {
  $_SESSION['msg'] = "<p>Erro: grupo não encontrado.</p>";
  header("Location: principal.php");
  exit();
}

?>