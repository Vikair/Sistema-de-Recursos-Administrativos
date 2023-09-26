<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
  // Redireciona para a página de login
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Perfil</title>
</head>
<style>

.eye-icon {
    font-size: 10px; /* Ajuste o tamanho do ícone conforme necessário */
  }
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

  .linkd button {
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    background-color: none;
    text-decoration: none;
   
    font-weight: 500;
    font-size: 1.1rem;
  }

  .linkd a {
    text-decoration: none
  }

  .linkd a:hover {
    text-decoration: underline;
    color: #f00
  }

  .eye-button:hover {
    background-color: initial;
  }

  #menu{
    text-decoration: underline
  }
</style>
<script>
    function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password-input');
    var passwordButton = document.getElementById('password-button');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      passwordButton.innerHTML = '<ion-icon name="eye-off" style="font-size: 10px;"></ion-icon>'; // Ajuste o tamanho do ícone conforme necessário
    } else {
      passwordInput.type = 'password';
      passwordButton.innerHTML = '<ion-icon name="eye" style="font-size: 10px;"></ion-icon>'; // Ajuste o tamanho do ícone conforme necessário
    }
  }
</script>
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
  <center>
    <div class="GrupoTela">
      <h2>
        Perfil de <?php echo $_SESSION['nome'] ?>
      </h2>
      <?php
      // Restante do código para exibir as informações do perfil
      // Obter os dados do usuário atual do banco de dados
      $sql_usuario = "SELECT * FROM USUARIO WHERE id_usuario = :id_usuario";
      $sql_query = $conn->prepare($sql_usuario);
      $sql_query->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
      $sql_query->execute();

     
      
while ($row_usuario = $sql_query->fetch(PDO::FETCH_ASSOC)) {
  echo "<li style='list-style: none'>";
  echo "Nome: " . $row_usuario['nome'] . "<br>";
  echo "Email: " . $row_usuario['email'] . "<br>";
  echo "Senha: <input type='password' id='password-input' value='" . $row_usuario['senha'] . "' disabled/>";
  echo '<div class="linkd" style="display: inline-block;">';
  echo "<button id='password-button' onclick='togglePasswordVisibility()' class='eye-button'><ion-icon class='eye-icon' name='eye'></ion-icon></button>";
  echo "</div><br>";
  echo '<div class="linkd" style="display: inline-block;">';
  echo "<a href='editar_perfil.php?id_usuario=" . $_SESSION['id_usuario'] . "'>Editar</a>";
  echo "</div><br>";
  echo '<div class="linkd">';
  echo "<a href='apagar_perfil.php?id_usuario=" . $_SESSION['id_usuario'] . "' onclick='return confirm(\"Tem certeza que deseja excluir seu perfil?\")'>Excluir</a>";
  echo "</div>";
  echo "</li>";
}
      ?>
    </div>
  </center>
  <script src="js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
