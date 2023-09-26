<?php
session_start();
include('conexao.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    if (empty($email)) {
        $_SESSION['msg_login'] = "<p class='error'>Preencha seu e-mail</p>";
        header("Location: index.php");
        exit();
    } elseif (empty($senha)) {
        $_SESSION['msg_login'] = "<p class='error'>Preencha sua senha</p>";
        header("Location: index.php");
        exit();
    } else {
        $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['adm'] = $usuario['adm'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['senha'] = $usuario['senha'];

            header("Location: principal.php");
            exit();
        } else {
            $_SESSION['msg_login'] = "<p class='error'>Falha ao logar! E-mail ou senha incorretos</p>";
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap');

        .error {
            color: red;
        }

        p {
            position: absolute;
        }
    </style>
    <title>Login</title>
</head>

<body class="body-login">
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
    <div id="login">
        <form action="" method="POST" id="form_login">
            <?php
            if (isset($_SESSION['msg_login'])) {
                echo $_SESSION['msg_login'];
                unset($_SESSION['msg_login']);
            }
            ?>

            <h1>
                Acesse sua conta
            </h1>
            <div class="input-container">
                <input type="text" name="email" class="inputLogin" required>
                <label class="labelLogin">
                    E-mail
                </label>
            </div>

            <div class="input-container">
                <input type="password" name="senha" class="inputLogin" required>
                <label class="labelLogin">
                    Senha
                </label>
            </div>

            <div>
                <button type="submit" class="submit-button">
                    Entrar
                </button>
            </div>

            <div class="cadastro">
                Não possui uma conta? <a href="cadastro.php">Inscreva-se</a>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
