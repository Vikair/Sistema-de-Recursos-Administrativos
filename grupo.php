<?php
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
require('protect.php');
include('conexao.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

if (!empty($id_grupo)) {
  $query_grupo = "SELECT id_usuario_criador FROM grupo WHERE id_grupo = :grupo_id";
  $stmt_grupo = $conn->prepare($query_grupo);
  $stmt_grupo->bindParam(':grupo_id', $id_grupo);
  $stmt_grupo->execute();
  $row_grupo = $stmt_grupo->fetch(PDO::FETCH_ASSOC);

  $adm_grupo = ($_SESSION['id_usuario'] == $row_grupo['id_usuario_criador']);

  $query_colaboradores = "SELECT u.id_usuario, u.nome, g.id_usuario_criador, c.nome AS nome_criador FROM usuario AS u
    INNER JOIN colaborador_grupo AS cg ON u.id_usuario = cg.usuario_id
    INNER JOIN grupo AS g ON g.id_grupo = cg.grupo_id
    INNER JOIN usuario AS c ON g.id_usuario_criador = c.id_usuario
    WHERE cg.grupo_id = :grupo_id";
  $stmt_colaboradores = $conn->prepare($query_colaboradores);
  $stmt_colaboradores->bindParam(':grupo_id', $id_grupo);
  $stmt_colaboradores->execute();
  $result_colaboradores = $stmt_colaboradores->fetchAll(PDO::FETCH_ASSOC);
} else {
  $_SESSION['msg'] = "<p>Erro: grupo não encontrado</p>";
  header("Location: principal.php");
  exit();
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Projeto</title>
  <style>
    .GrupoTela {
      border: 1px solid #000;
      padding: 20px;
      width: 45%;
      background: white;
      box-shadow: 10px 20px grey;
      border-radius: 10px 20px 30px;
      margin: 35px auto;
      text-align: center;
    }

    .ButtonVoltar button {
      background: #c7c5c5;
      border-radius: 20px;
      width: 5%;
      color: black;
      font-weight: 500;
      font-size: 1.1rem;
    }

    .ButtonVoltar button:hover {
      width: 6%;
      font-size: 1.5rem;
    }

    .ButtonTarefa button {
      width: 50%;
      padding: 15px;
      color: black;
      background-color: #c7c5c5;
      cursor: pointer;
      border-radius: 10px;
      margin: 0 auto;
      color: black;
      font-weight: 500;
      font-size: 1.1rem;
    }

    .ButtonTarefa button:hover {
      font-size: 1.25rem;
    }
.bota button{
  color:black;
  border:none;
}
.bota button:hover{
  background-color: whitesmoke;
}
    
  </style>
</head>

<body>
<header>
    <nav class="nav-bar">
      <div class="logo">
        <h1>
          <ion-icon name="cafe-outline"></ion-icon>
          S.R.A
        </h1>
      </div>
      <div class="nav-list">
        <ul>
          <li class="nav-item">
            <a href="menu.php" class="nav-link">
              Início
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>" class="nav-link">
              Menu
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>" class="nav-link">
              Perfil
            </a>
          </li>
        </ul>
      </div>
      
      <div class="mobile-menu-icon">
        <button onclick="menuShow()">
          <img class="icon" src="assets/img/menu_white_36dp.svg" alt="">
        </button>
      </div>
    </nav>
    <div class="mobile-menu">
      <ul>
        <li class="nav-item">
          <a href="menu.php" class="nav-link">
            Início
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>" class="nav-link">
            Menu
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>" class="nav-link">
            Perfil
          </a>
        </li>
      </ul>
      
  </header>
  <br><br><br><br>
  <div class="GrupoTela">
    <div class="ButtonVoltar">
      <button onclick="window.location.href='principal.php'">
        X
      </button>
    </div>
    <h1>
      <p>
        <?php echo $nome_grupo; ?>
      </p>
        </h1>

      <span>
      Descrição:
      <?php 
      
      $query_desc_grupo = "SELECT desc_grupo FROM grupo WHERE id_grupo = $id_grupo";
      $result_desc_grupo = mysqli_query($conexao, $query_desc_grupo);
      while ($row_desc_grupo = mysqli_fetch_assoc($result_desc_grupo)) {
        echo $row_desc_grupo['desc_grupo'];
      }
      
      
      
      ?>
      </span><br>
      <br>
      <h2>
        <br>
      <p>
        Colaboradores do Projeto:
      </p>
      </h2>
      <span>
      <?php if (!empty($result_colaboradores)) : ?>
        <ul style="list-style: none;">
          <?php
          $criador_encontrado = false;
          foreach ($result_colaboradores as $colaborador) {
            $nome_colaborador = $colaborador['nome'];
            $id_usuario_colaborador = $colaborador['id_usuario'];
            $id_usuario_criador = $colaborador['id_usuario_criador'];
            $nome_criador = $colaborador['nome_criador'];

            if ($id_usuario_criador == $row_grupo['id_usuario_criador']) {
              $criador_encontrado = true;
            }
          ?>
          
            <li>
              <?php echo $nome_colaborador; ?>
              <?php if ($_SESSION['adm'] == 1 || $id_usuario_criador == $id_usuario_colaborador) : ?>
                <div class="bota"><button onclick="confirmarExclusaoColaborador(<?php echo $id_usuario_colaborador; ?>, '<?php echo $nome_grupo; ?>', '<?php echo $id_grupo ?>')">
                <ion-icon name="trash-outline"></ion-icon>
                </button></div>
              <?php endif; ?>
            </li>
              
          <?php } ?>
        </ul>
        <h3>
        <?php if ($criador_encontrado) : ?>
          <p>(Criador do grupo: <?php echo $nome_criador; ?>)</p>
        <?php endif; ?>
      <?php else : ?>
        <p>
          Nenhum colaborador encontrado
        </p>
        </h3>
      <?php endif; ?>
      </span>
    
    <br>
    <p>
      Código do projeto:
      <span style="color:limegreen">
        <?php echo $id_grupo; ?>
      </span>
      (use este codigo para convidar alguém para o seu projeto)
    </p>
    
    <br><br><br><br>
    <?php
    $TarefasHref = "tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo";
    $RelatoriosHref = "criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo";
    ?>
    <div class="ButtonTarefa">
      <button onclick="window.location.href='<?php echo $TarefasHref ?>'">
        Menu de tarefas
      </button>
      <br><br>
      <button onclick="window.location.href='<?php echo $RelatoriosHref ?>'">
        Menu de Relatórios
      </button>
      <br><br>
      <?php if ($_SESSION['adm'] == 1) : ?>
        <button onclick="confirmarExclusao('<?php echo $id_grupo; ?>')">
          Excluir
        </button>
      <?php endif; ?>
    </div>
  </div>
  </center>

  <footer>

  </footer>

  <script src="js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script>
    function confirmarExclusao(idGrupo) {
      if (confirm("Tem certeza que deseja excluir o Projeto?")) {
        window.location.href = "apagar_grupo.php?id_grupo=" + idGrupo;
      }
    }

    function confirmarExclusaoColaborador(idColaborador) {
      if (confirm("Tem certeza que deseja excluir o colaborador?")) {
        window.location.href = "apagar_colaborador.php?id_colaborador=" + idColaborador;
      }
    }
  </script>
</body>

</html>
