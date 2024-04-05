<?php
session_start();
include_once('../templates/hearder.php');
include_once('..\Connection/conectabd.php');

if (isset($_POST['produto_id']) && isset($_POST['quantidade'])) {

    // Obtém o ID do produto
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $sql = "SELECT * FROM produtos WHERE codigo = $produto_id ";


    // Executa a consulta SQL
    $result = $pdo->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        // Obtém os dados do produto
        $produto = $result->fetch(PDO::FETCH_ASSOC);

        // Verifica se o produto foi encontrado
        if ($produto) {
            // Cria um array com as informações do produto
            $produto_info = array(
                'id' => $produto['codigo'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => $quantidade
                // Adicione mais informações conforme necessário
            );

            // Adiciona o produto ao carrinho (sessão)
            $_SESSION['carrinho'][] = $produto_info;
        } else {
            // Produto não encontrado
            echo "Produto não encontrado.";
        }
    } else {
        // Erro na consulta SQL
        echo "Erro na consulta SQL: " . $pdo->errorInfo()[2];
    }
}

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

    <div class="carrinho">
        <h1 class="titulo">Carrinho de Compras</h1>
        <?php
        $precoTotal = 0;
        // Verifica se o carrinho não está vazio
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            // Loop para exibir os produtos no carrinho
            foreach ($_SESSION['carrinho'] as $produto_info) {
                // Recupera o preço do produto do banco de dados (no formato money)
                $preco_bd = $produto_info['preco'];

                // Remove os caracteres não numéricos (como "R$" e vírgulas) do preço
                $preco_sem_simbolos = preg_replace('/[^\d,.]/', '', $preco_bd);

                // Converte o preço para um número (float)
                $preco = floatval(str_replace(',', '.', $preco_sem_simbolos));

                $quantidade = intval($produto_info['quantidade']);

                // Aqui você pode buscar os detalhes do produto no banco de dados e exibir
                echo "<div class='produtos'>";
                echo "<p>Produto ID: {$produto_info['id']}</p>";
                echo "<p>Nome: {$produto_info['nome']}</p>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "<p>Preço: {$produto_info['preco']}</p>";
                $precoTotal += $preco * $quantidade;
                echo "</div>";

              
                
            }
            echo "<form action='../Connection/fazerPedido.php' method='POST'>";

            // echo "<label for='nome'>Nome:</label>";
            // echo "<input type='text' id='nome' name='nome' required><br><br>";
            // echo "<label for='rg'>RG:</label>";
            // echo "<input type='text' id='rg' name='rg' required><br><br>";
            echo "<label for='endereco'>Endereço:</label>";
            echo "<input type='text' id='endereco' name='endereco' required><br><br>";
            echo "<label for='rg'>RG:</label>";
            echo "<input type='text' id='rg' name='rg' required><br><br>";
            
            // echo "<input type='hidden' name='codigo' value= '" .$produto_info['id']. "'</input> ";
            // echo "<input type='hidden' name='nome' value= '" .$produto_info['nome']. "'</input> ";
            // echo "<input type='hidden' name='quantidade' value= '" .$quantidade. "'</input> ";
            // echo "<input type='hidden' name='preco' value= '" .$produto_info['preco']. "'</input> ";
            echo "<input type='hidden' name='precoTotal' value= '"  .$precoTotal. "'</input>";
            
            echo "<button type='submit' id='pedido' name='pedido'>Fazer Pedido</button>";
            echo "</form>";

            echo "<p>Preço Total: R$$precoTotal,00</p>";
        } else {
            echo "<p>O carrinho está vazio</p>";
        }

        ?>
        <form action="../Connection/limparCarrinho.php" method="post">
            <div class="limpar">
                <button type="submit" name="limpar">Limpar Carrinho</button>
            </div>
        </form>
       
    </div>
    <style>
        .titulo {
            display: flex;
            justify-content: center;
        }

        .produtos {
            display: flex;
            justify-content: space-around;
        }
    </style>
</body>

</html>