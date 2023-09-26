<?php
if (!isset($_SESSION)) {
  session_start();
}

require('protect.php');
include('conexao.php');

$id_colaborador = $_GET['id_colaborador'];
$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

if (!empty($id_colaborador)) {
  $query_grupo = "SELECT grupo_id FROM colaborador_grupo WHERE usuario_id = :id_colaborador";
  $stmt_grupo = $conn->prepare($query_grupo);
  $stmt_grupo->bindParam(':id_colaborador', $id_colaborador);
  $stmt_grupo->execute();
  $row_grupo = $stmt_grupo->fetch(PDO::FETCH_ASSOC);

  if ($row_grupo) {
    $grupo_id = $row_grupo['grupo_id'];

    $query_permissoes = "SELECT id_usuario_criador FROM grupo WHERE id_grupo = :grupo_id";
    $stmt_permissoes = $conn->prepare($query_permissoes);
    $stmt_permissoes->bindParam(':grupo_id', $grupo_id);
    $stmt_permissoes->execute();
    $row_permissoes = $stmt_permissoes->fetch(PDO::FETCH_ASSOC);

    if ($_SESSION['id_usuario'] == $row_permissoes['id_usuario_criador'] || $_SESSION['adm'] == 1) {
      $query_excluir = "DELETE FROM colaborador_grupo WHERE usuario_id = :id_colaborador";
      $stmt_excluir = $conn->prepare($query_excluir);
      $stmt_excluir->bindParam(':id_colaborador', $id_colaborador);
      $stmt_excluir->execute();

      header("Location: principal.php");
      exit();
    }
  } 
}

echo "<p>Erro ao excluir o colaborador.</p>";
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

require('protect.php');
include('conexao.php');

$id_colaborador = $_GET['id_colaborador'];
$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

if (!empty($id_colaborador)) {
  $query_grupo = "SELECT grupo_id FROM colaborador_grupo WHERE usuario_id = :id_colaborador";
  $stmt_grupo = $conn->prepare($query_grupo);
  $stmt_grupo->bindParam(':id_colaborador', $id_colaborador);
  $stmt_grupo->execute();
  $row_grupo = $stmt_grupo->fetch(PDO::FETCH_ASSOC);

  if ($row_grupo) {
    $grupo_id = $row_grupo['grupo_id'];

    $query_permissoes = "SELECT id_usuario_criador FROM grupo WHERE id_grupo = :grupo_id";
    $stmt_permissoes = $conn->prepare($query_permissoes);
    $stmt_permissoes->bindParam(':grupo_id', $grupo_id);
    $stmt_permissoes->execute();
    $row_permissoes = $stmt_permissoes->fetch(PDO::FETCH_ASSOC);

    if ($_SESSION['id_usuario'] == $row_permissoes['id_usuario_criador'] || $_SESSION['adm'] == 1) {
      $query_excluir = "DELETE FROM colaborador_grupo WHERE usuario_id = :id_colaborador";
      $stmt_excluir = $conn->prepare($query_excluir);
      $stmt_excluir->bindParam(':id_colaborador', $id_colaborador);
      $stmt_excluir->execute();

      header("Location: principal.php");
      exit();
    }
  } 
}

echo "<p>Erro ao excluir o colaborador.</p>";
?>
