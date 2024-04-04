<?php
// Inicia a sessão
session_start();

// Limpa a sessão do carrinho de compras
session_unset();
session_destroy();

// Redireciona para a página inicial ou outra página de sua escolha
header('Location: ../View/carrinho.php'); // Altere 'index.php' para a página desejada
exit();
?>