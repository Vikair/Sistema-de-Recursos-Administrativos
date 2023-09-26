<?php
if (!isset($_SESSION)) {
  session_start();
}

include('conexao.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

$usuario_id = $_SESSION['id_usuario'];
$grupo_id = $_GET['id_grupo'];

$tarefa_nome = isset($_POST['nome_tarefa']) ? $_POST['nome_tarefa'] : '';
$desc_tarefa = isset($_POST['desc_tarefa']) ? $_POST['desc_tarefa'] : '';

$status_tarefa = $_POST['status_tarefa'];
$colaborador_id = isset($_POST['colaborador_id']) ? $_POST['colaborador_id'] : null;
if ($colaborador_id === "") {
  $colaborador_id = null; }

$query_grupo = "SELECT id_grupo, nome_grupo, desc_grupo FROM grupo";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

$incluir = "INSERT INTO tarefa (nome_tarefa, desc_tarefa, usuario_id, grupo_id, status_tarefa, colaborador_id)
                  VALUES (:nome_tarefa, :desc_tarefa, :usuario_id, :grupo_id, :status_tarefa, :colaborador_id)";

$result_inserir = $conn->prepare($incluir);
$result_inserir->bindParam(':nome_tarefa', $tarefa_nome);
$result_inserir->bindParam(':desc_tarefa', $desc_tarefa);
$result_inserir->bindParam(':usuario_id', $usuario_id);
$result_inserir->bindParam(':grupo_id', $grupo_id);
$result_inserir->bindParam(':status_tarefa', $status_tarefa);
$result_inserir->bindParam(':colaborador_id', $colaborador_id, PDO::PARAM_INT | PDO::PARAM_NULL);
// Executa a inserção da tarefa
$result_inserir->execute();

if ($result_inserir) {
  
  $query_status = "SELECT nome_status FROM tarefa_status WHERE id_status = :nome_status";
  $result_status = $conn->prepare($query_status);
  $result_status->bindParam(':nome_status', $status_tarefa);
  $result_status->execute();
  $nome_status = $result_status->fetchColumn();

  while ($row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC)) {
    extract($row_grupo);
    header("location: tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo&tarefa_status=$nome_status");
    
  }
} else {
  echo "Não foi possível incluir a tarefa.";
}

header("location: tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
?>