<?php
session_start();

include_once('..\Connection/conectabd.php');

if (isset($_POST['pedido'])) {

    // Obtém o ID do produto
    $precoTotal = $_POST['precoTotal'];
    $rg = $_POST['rg'];
    $endereco = $_POST['endereco'];
    $situacao = 'Pendente'; 
    $data = date('Y-m-d H:i:s'); // Obtém a data atual

    // Prepara e executa a  instrução SQL de inserção
    $sql = "INSERT INTO pedido (situacao, data, total, rg) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$situacao, $data, $precoTotal, $rg]);

    // Verifica se a inserção foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        echo "Pedido inserido com sucesso.";
        header("Location: ../Connection/limparCarrinho.php");
        exit;
    } else {
        echo "Erro ao inserir o pedido.";
    }
}   