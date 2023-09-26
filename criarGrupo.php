<?php
require('protect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Criar Projeto</title>
</head>
<style>
    .inputtype {
        position: relative;
        border: none;
    }

    .inputNome {
        position: relative;
        background: none;
        border: none;
        border-bottom: 1px solid white;
        outline: none;
        color: black;
        font-size: 15px;
        width: 90%;
        letter-spacing: 2px;
    }

    .labelinput {
        position: absolute;
        top: 0px;
        left: 0px;
        pointer-events: none;
        transition: .5s;
    }

    .inputNome:focus~.labelinput,
    .inputNome:valid~.labelinput {
        top: -20px;
        font-size: 13px;
    }

    .submit-button {
        width: 96%;
        border: none;
        padding: 15px;
        color: black;
        font-size: 15px;
        cursor: pointer;
        border-radius: 10px;
    }

    .submit-button:hover {
        background-color: #528B8B;
    }

    .login {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 15px;
        border-radius: 15px;
        width: 30%;
        border: none;
    }

    legend {
        border: 1px solid #D9D9D9;
        padding: 10px;
        text-align: center;
        background-color: #D9D9D9;
        color: black;
    }

    textarea {
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    textarea {
        padding: 10px;
        width: 90%;
        line-height: 1.5;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 1px 1px 1px #999;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    #menu{
        text-decoration: underline
    }
</style>

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
                        <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>" id="menu" class="nav-link">
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
    <div class="login">
        <form action="novo_grupo.php" method="POST" id="form_CGrupo">
            <br><br><br><br>
            <legend>
                <b>
                    Criar Projeto
                </b>
            </legend>
            <br><br>
            <div class="inputtype">
                <input type="text" name="nome_grupo" class="inputNome" required>
                <label class="labelinput">
                    Nome do Projeto
                </label>
            </div>
            <br><br><br>
            <div class="inputtype">
                Descrição
                <textarea name="desc_grupo" placeholder="Descreva brevemente seu Projeto" rows=10 cols=35 maxlength="250">
                    
                </textarea>
                <required>
                    <label class="labelinput">

                    </label>
            </div>
            <br>
            <div>
                <button type="submit" class="submit-button">
                    Criar
                </button>
            </div>
        </form>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
