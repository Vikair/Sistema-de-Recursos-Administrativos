<?php
session_start();
include('conexao.php');
require('protect.php');

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id_usuario = $_SESSION['id_usuario'];

    // Atualiza as informações do perfil no banco de dados
    $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id_usuario', $id_usuario);

    if ($stmt->execute()) {
        header("Location: perfil.php");
        exit();
    } else {
        echo "Ocorreu um erro ao atualizar as informações do perfil.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Editar Perfil</title>
</head>
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
  #butaob{
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    background-color: #957E6C;
    text-decoration: none;
    color: #fff;
    font-weight: 500;
    font-size: 1.1rem;
  } 

  #menu{
    text-decoration: underline
  }
</style>
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
          <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>" id="menu" class="nav-link">
            Perfil
          </a>
        </li>
      </ul>
    </div>
    <div class="login-button">
      <?php if (isset($_SESSION['id_usuario'])) : ?>
        <button onclick="window.location.href='logout.php';">
          Sair
        </button>
      <?php else : ?>
        <button onclick="window.location.href='index.php';">
          Entrar
        </button>
      <?php endif; ?>
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
    <div class="login-button">
      <?php if (isset($_SESSION['id_usuario'])) : ?>
        <button onclick="window.location.href='logout.php';">
          Sair
        </button>
      <?php else : ?>
        <button onclick="window.location.href='index.php';">
          Entrar
        </button>
      <?php endif; ?>
    </div>
  </div>
</header>
<body>
    <br><br><br><br>
<div class="GrupoTela">
    <h2>EDITAR PERFIL</h2>
    <form action="" method="post" id="todo-form">
        <br>
        <label for="nome">Nome:</label>
        <input name="nome" type="text" id="todo-input" value="<?php echo $_SESSION['nome']; ?>" required/><br>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="todo-input" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required/><br>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha-input" name="senha" value="<?php echo isset($_SESSION['senha']) ? $_SESSION['senha'] : ''; ?>" required/><br>
        <br>
        <center>
        <button type="button" id="butaob" onclick="togglePasswordVisibility()">Revelar senha</button><br>
        <br>
        <button type="submit" id="butaob" >Atualizar</button>
      </center>
    </form>

    <script>
        function togglePasswordVisibility() {
            var senhaInput = document.getElementById('senha-input');
            var senhaButton = document.getElementById('senha-button');

            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                senhaButton.textContent = 'Ocultar senha';
            } else {
                senhaInput.type = 'password';
                senhaButton.textContent = 'Revelar senha';
            }
        }
    </script>
    </div>
    <script src="js/script.js"></script>
<script type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
