<?php
if (!isset($_SESSION)) {
    session_start();
}
include('protect.php');
include('conexao.php');

$nome_grupo = isset($_GET['nome_grupo']) ? $_GET['nome_grupo'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Painel</title>
</head>
<style>
    .grupos {
        border: 1px solid #000;
        padding: 10px;
        width: 12%;
        background: white;
        border-radius: 10px 20px 30px;
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
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <center>
        <div class="boxtags">

            <legend> Bem vindo ao SRA, <?php echo $_SESSION['nome']; ?>. </legend>
            <br>

            <a href="criarGrupo.php"> <button class="butao">Criar Projeto</button> </a> <br>
            <a href="entrarGrupo.php"> <button class="butao">Entrar em um Projeto</button></a> <br>

        </div>
    </center>
    <footer>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        // Consultar os grupos do usuário e dos quais é colaborador
        $query_grupo = "SELECT DISTINCT g.id_grupo, g.nome_grupo, g.desc_grupo
                FROM grupo g
                LEFT JOIN colaborador_grupo cg ON g.id_grupo = cg.grupo_id 
                WHERE cg.usuario_id = $_SESSION[id_usuario] OR g.usuario_id = $_SESSION[id_usuario]
                ORDER BY g.id_grupo DESC";
        $result_grupo = $conn->prepare($query_grupo);
        $result_grupo->execute();

        while ($row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC)) {
            extract($row_grupo);
            echo  '  <div class="grupos">PROJETO:<a href="grupo.php?id_grupo=' . $id_grupo . '&nome_grupo=' . $nome_grupo . '">' . $row_grupo['nome_grupo'] . '</a></div>';
        }
        ?>
    </footer>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
