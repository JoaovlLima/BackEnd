<?php
session_start();

include_once('F:\Arquivos\Lição\PROGRAMACAO\2024\BackEnd\PhpProjetos\ProjetoPizza(joaoLima)\ProjPizza\Connection/conectabd.php');

if (isset($_POST['pedido'])) {

    // Obtém o ID do produto
    $numero = 2;
    $precoTotal = $_POST['precoTotal'];
    $rg = $_POST['rg'];
    $endereco = $_POST['endereco'];
    $situacao = 'Pendente'; 
    $data = date('Y-m-d H:i:s'); // Obtém a data atual

    // Prepara e executa a  instrução SQL de inserção
    $sql = "INSERT INTO pedido (numero, situacao, data, total, rg) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$numero, $situacao, $data, $precoTotal, $rg]);

    // Verifica se a inserção foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        echo "Pedido inserido com sucesso.";
        header("Location: ../Connection/limparCarrinho.php");
        exit;
    } else {
        echo "Erro ao inserir o pedido.";
    }
}   