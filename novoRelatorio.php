<?php
session_start();


  include('conexao.php');

    $id_grupo = $_GET['id_grupo'];
    $nome_grupo = $_GET['nome_grupo'];


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $data = date("Y-m-d");
        $hora = date("H:i:s");
    }
       
      

       
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

 
        $sql = "INSERT INTO relatorio (titulo, descricao, data_relatorio, hora, nome_usuario) VALUES ('$titulo', '$descricao', '$data', '$hora', '$_SESSION[nome]')";
        if ($conexao->query($sql) === TRUE) {
            echo "Relatório salvo com sucesso.";
            header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
        } else {
            echo "Erro ao salvar o relatório: " . $conexao->error;
            header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
        }
            
        
        ?>