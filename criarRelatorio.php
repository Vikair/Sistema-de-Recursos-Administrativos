<?php
include('conexao.php');
require('protect.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .aprovado {
            border: 2px solid green;
            border-radius: 8px;
            width: fit-content;
        }

        .aprovado {
    border: 2px solid green;
    border-radius: 8px;
}

.botoes {
    display: flex;
    margin: auto;
    justify-content: center;
    padding: 5px 30px;
    outline: none;
    border: none;
    color: #f8f9fa;
    font-size: 16px;
    border-radius: 15px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 20px;
}

.botoes a, .botoes button {
    padding: 8px 12px;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    cursor: pointer;
}

.botoes a.editar-button {
    background-color: #1E90FF;
}

.botoes a.excluir-button {
    background-color: #FF4500;
}

.botoes button.aprovar-button {
    background-color: #4CAF50;
}
.relatorio{
    width:400px;
    word-wrap: break-word;

}

    </style>
    <title>Sistema de Relatórios</title>
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
                    <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>"
                       class="nav-link">
                        Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>"
                       class="nav-link">
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
                <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>"
                   class="nav-link">
                    Menu
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>"
                   class="nav-link">
                    Perfil
                </a>
            </li>
        </ul>
        
</header>
<center>
    <br><br>
    <br><br><br><br>
    <h1>Relatório</h1>
    <form action="novoRelatorio.php?id_grupo=<?php echo $id_grupo ?>&nome_grupo=<?php echo $nome_grupo ?>"
          method="POST">
        <?php
        if (isset($_SESSION['msg_relatorio_excluido'])) {
            echo $_SESSION['msg_relatorio_excluido'];
            unset($_SESSION['msg_relatorio_excluido']);
        }
        ?>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" boder=none rows=10 cols=50 maxlength="250" required></textarea><br><br>

        <input type="submit" value="Salvar">
    </form>

    <h2>Relatórios existentes:</h2>
    <?php
    // Verificar conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Consultar relatórios existentes
    $sql = "SELECT * FROM relatorio";
    $resultado = $conexao->query($sql);

    // Exibir relatórios
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $relatorioId = $row['id_relatorio'];
            $classeAprovado = $row['aprovado'] ? 'aprovado' : '';
            $classeBotoes = $row['aprovado'] ? 'botoes aprovado' : 'botoes';
    
            echo "<div class='relatorio $classeAprovado' data-id='$relatorioId'>";
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p>" . $row["descricao"] . "</p>";
            echo "<p>" . $row["data_relatorio"] . "</p>";
            echo "<p>" . $row["nome_usuario"] . "</p>";
            echo "<div class='$classeBotoes'>";
            echo "<a class='editar-button' href='editar_relatorio.php?id_relatorio=$relatorioId&id_grupo=$id_grupo&nome_grupo=$nome_grupo'><ion-icon name='create-outline'></ion-icon></a>";
            echo "<a class='excluir-button' href='apagar_relatorio.php?id_relatorio=$relatorioId&id_grupo=$id_grupo&nome_grupo=$nome_grupo' onclick='return confirm(\"Tem certeza que deseja excluir o relatório?\")'><ion-icon name='trash-outline'></ion-icon></a>";

            echo "<button class='aprovar-button'><ion-icon name='checkmark-outline'></ion-icon></button><br>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Nenhum relatório encontrado.";
    }


    $conexao->close();
    ?>
    <script>
        const relatorios = document.querySelectorAll('.relatorio');

relatorios.forEach(relatorio => {
    const botaoAprovar = relatorio.querySelector('.aprovar-button');

    botaoAprovar.addEventListener('click', () => {
        relatorio.classList.toggle('aprovado');
        const relatorioId = relatorio.getAttribute('data-id');
        const aprovado = relatorio.classList.contains('aprovado') ? 1 : 0;

    
        fetch(`atualizar_aprovacao.php?id_relatorio=${relatorioId}&aprovado=${aprovado}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao atualizar a aprovação do relatório.');
                }
             
            })
            .catch(error => {
                console.error(error);
               
            });
    });
});

    </script>
</center>
<script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
