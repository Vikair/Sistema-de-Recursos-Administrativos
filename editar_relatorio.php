<?php
include('conexao.php');
require('protect.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Atualiza as informações do relatório no banco de dados
    $sql = "UPDATE relatorio SET titulo = :titulo, descricao = :descricao WHERE id_relatorio = :id_relatorio";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_relatorio', $_GET['id_relatorio']);

    if ($stmt->execute()) {
        header("Location: criarRelatorio.php?&id_grupo=$id_grupo&nome_grupo=$nome_grupo");
        exit();
    } else {
        echo "Ocorreu um erro ao atualizar o relatório.";
    }
}

// Consulta o relatório existente
$sql = "SELECT * FROM relatorio WHERE id_relatorio = :id_relatorio";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_relatorio', $_GET['id_relatorio']);
$stmt->execute();
$relatorio = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o relatório existe
if (!$relatorio) {
    echo "O relatório não foi encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/styles.css">
    <title>Editar Relatório</title>
</head>
<style>
    #form_relatorio {
        margin-top: 50px;

    }

    .titulo {
        margin-top: 100px;

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
        <br><br>
        <h1 class="titulo">
            Editar Relatório
        </h1>
        <form action="editar_relatorio.php?id_relatorio=<?php echo $_GET['id_relatorio']; ?>&id_grupo=<?php echo $id_grupo; ?>&nome_grupo=<?php echo $nome_grupo; ?>" id="form_relatorio" method="POST">
            <label for="titulo">
                Título:
            </label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $relatorio['titulo']; ?>" required>
            <br><br>
            <label for="descricao">
                Descrição:
            </label>
            <br>
            <textarea name="descricao" id="descricao" rows="10" cols="50" required><?php echo $relatorio['descricao']; ?></textarea>
            <br><br>
            <input type="submit" value="Salvar">
        </form>

        <script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
