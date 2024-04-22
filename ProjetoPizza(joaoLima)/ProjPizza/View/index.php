<?php
// include_once('../templates/hearder.php');
include_once(' F:\Arquivos\Lição\PROGRAMACAO\2024\BackEnd\ProjetoPizza(joaoLima)\ProjPizza\/templates/hearder.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>
<body>
    <header>
    <?=template_header('Visualizar Pedidos')?>
    </header>

    <div class="carousel">
        <!-- Seu carrossel aqui -->
    </div>

    <div class="image-section">
        <h2>Título da Seção</h2>
        <div class="image-container">
            <img src="/img/oferta1.png" alt="Pizza 1">
            <img src="/img/oferta2.png" alt="Pizza 2">
            <img src="/img/oferta3.jpg" alt="Pizza 3">
        </div>
    </div>

    <div class="purchase-section">
        <h2>Título da Área de Compra</h2>
        <div class="areaCard">
        <?php
            include_once('..\Connection/conectabd.php');

            // Inicializa a condição da cláusula WHERE
            // $whereCondition = '';

            // // Verifica se a tag foi enviada via GET e não está vazia
            // if (isset($_GET['tag']) && $_GET['tag'] !== '') {
            //     // Obtém a tag selecionada
            //     $selectedTag = $_GET['tag'];

            //     // Cria a condição WHERE com base na tag selecionada
            //     $whereCondition = "WHERE tag = '$selectedTag'";
            // }

            // Monta a query SQL com base na condição WHERE
            $sql = "SELECT * FROM produtos";
            $result = $pdo->query($sql);
            if (!$result) {
    die("Erro na consulta: " . $conexao->error);
} 

            // Exibe os cards de acordo com os resultados da consulta
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                
                
                echo "<div class='card'>";
                echo "<img src='pizza_image.jpg' alt='Pizza Image' class='card-image'>";
                echo "<div class='card-details'>";
                echo "<h3>" . $row['nome'] . "</h3>";
                echo "<p>" . $row['descricao'] . "</p>";
                echo "</div>";
                echo "<div class='card-bottom'>";
                echo "<h3>" . $row['preco'] . "</h3>";
                echo "<form action='carrinho.php' method='POST'>";
                echo "<input type='number' name='quantidade'>";
                echo " <input type='hidden' name='produto_id' value= '" .$row['codigo']. "'</input> ";
                echo "<button type='submit' id='comprar' name='comprar'>Comprar</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
               
            }
            
        ?>

        <!-- Adicione mais cards conforme necessário -->
        </div>
    </div>  
   <?php ?>     
  <?php  
  ?>
  <script>

  </script>
</body>
</html>