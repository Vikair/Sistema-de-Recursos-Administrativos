<?php
session_start();
include('conexao.php');

$id_relatorio = $_GET['id_relatorio'];
$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];


$query_relatorio = "SELECT id_relatorio FROM relatorio WHERE id_relatorio = :id_relatorio";
$stmt_relatorio = $conn->prepare($query_relatorio);
$stmt_relatorio->bindParam(':id_relatorio', $id_relatorio);
$stmt_relatorio->execute();

if ($stmt_relatorio->rowCount() != 0) {
  $query_delete_relatorio = "DELETE FROM relatorio WHERE id_relatorio = :id_relatorio";
  $stmt_delete_relatorio = $conn->prepare($query_delete_relatorio);
  $stmt_delete_relatorio->bindParam(':id_relatorio', $id_relatorio);
  $stmt_delete_relatorio->execute();

  $_SESSION['msg_relatorio_excluido'] = "<p>Relatório excluído com sucesso.</p>";
  header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
 
} else {
  $_SESSION['msg_perfil_excluido'] = "<p>Relatório não encontrado.</p>";
  header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
 
}
?>
