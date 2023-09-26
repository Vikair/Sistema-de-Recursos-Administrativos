<?php
include('conexao.php');
require('protect.php');

$id_relatorio = $_GET['id_relatorio'];
$aprovado = $_GET['aprovado'];

// Atualizar o campo "aprovado" no banco de dados
$sql = "UPDATE relatorio SET aprovado = '$aprovado' WHERE id_relatorio = '$id_relatorio'";
if ($conexao->query($sql) === TRUE) {
    // Sucesso na atualização
    http_response_code(200); // Código de resposta OK
} else {
    // Erro na atualização
    http_response_code(500); // Código de resposta Internal Server Error
}

// Fechar conexão
$conexao->close();
?>
