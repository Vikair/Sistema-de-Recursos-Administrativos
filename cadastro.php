<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>cadastro</title>
    <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap');
 
        .success {
            color: green;
        }
        .error {
            color: red;
        }

        #cadastro #form_cadastro {
            padding-bottom: 95px;
        }
    </style>
    <!-- <title> Cadastro </title> -->
</head>

<body class="body-cadastro">
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
    <script src="js/script.js"></script>
    <!-- <center> -->
    <!-- <h1>Cadastro</h1> -->
    <div id="cadastro">
        <form action="cadastrar.php" id="form_cadastro" method="POST">
            <?php
            session_start();

            if (isset($_SESSION['msg_cadastro'])) {
                echo $_SESSION['msg_cadastro'];
                unset($_SESSION['msg_cadastro']);
            }

            ?>
            <h1>
                Cadastre sua conta
            </h1>
            <div class="input-container">
                <input type="text" name="nome" class="inputCadastro" required>
                <label class="labelCadastro">
                    Digite seu nome
                </label>
            </div>
            <div class="input-container">
                <input type="text" name="email" class="inputCadastro" required>
                <label class="labelCadastro">
                    Digite seu email
                </label>
            </div>
            <div class="input-container">
                <input type="text" name="senha" class="inputCadastro" required>
                <label class="labelCadastro">
                    Digite sua senha
                </label>
            </div>
            <div>
                <button type="submit" class="submit-button" value="Cadastrar">
                    Cadastrar
                </button>
            </div>
            <div class="cadastro">
                Já tem uma conta?
                <a href=index.php>
                    Logar
                </a>
            </div>
        </form>
    </div>
    <!-- </center> -->
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
