<?php

session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Menu Responsivo</title>
</head>
<style>
    .landbox {
        border: 1px solid #000;
        padding: 30px;
        width: 65%;
        background: white;
        box-shadow: 10px 20px grey;
        border-radius: 10px 20px 30px;
        position: relative;
        z-index: -1;
        padding-bottom: 30px;
        margin-bottom: 40px;
        bottom: -125px;
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
                        <a href="menu.php" id="menu" class="nav-link">
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
    <center>
        
        <div class="landbox">
            <h1>Sobre o Sistema de Recursos Administrativos</h1>
            <br>
            <p>Tendo observado um problema inerente a gestão de pessoas, nós buscamos identificar um órgão público que mais necessitasse de coletar dados sobre seu funcionamento interno e gerenciamento de seus recursos pessoais.</p>
            <br>
            <p>Coletamos os dados através da chefe do Conselho Tutelar da cidade de Caaporã-PB, a senhora Reilza Eneia, que nos falou da dificuldade de gerenciar a administração e gerenciamento interno do conselho tutelar. Devido à alta carga de trabalho e a necessidade de organizar os afazeres da unidade entre os conselheiros unitários.</p>
            <br>
            <p>Em questões como estrutura organizacional e gestão interna dos órgãos sociais, nosso sistema permite que os órgãos maximizem suas atividades ao garantir que todos os recursos serão usados com sabedoria e propósito.</p>
            <br>
            <p>O Sistema de Recursos Administrativos inclui o estabelecimento de relatórios e objetivos organizacionais para identificar os recursos necessários para atingir esses objetivos. Alocando e implementando os recursos de acordo com as prioridades observadas pelos usuários, com medidas para avaliar e monitorar o desempenho e a eficácia do grupo.</p>
            <br>
            <p>O sistema pode ser utilizado em diversos ambientes como comércios, governos, organizações sem fins lucrativos e outras entidades necessitadas, gerenciando seus recursos com eficiência.</p>
            <br>
            <p>O S.R.A é adequado para o gerenciamento interno de objetivos, recursos disponíveis e desafios empresariais. O nosso produto será um site que terá as funcionalidades necessárias para a administração de um empreendimento ou organismo público, em que um gestor e seus funcionários irão compartilhar de um mesmo ambiente web. Publicando relatórios e protocolos para facilitar a comunicação e a organização dos materiais de empreendimento.</p>
        </div>
    </center>
    <script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
