<?php

use LDAP\Result;
include_once('../templates/hearder.php');
require_once '..\Connection/conectabd.php';
// session_start();
// if (empty($_SESSION)) {
//     // Significa que as variáveis de SESSAO não foram definidas.
//     // Não pode acessar aqui. o sistema manda voltar para a pagina de login
//     header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
//     die();
// }

// Verifica se foi submetido um formulário de pesquisa
if(isset($_POST['pesquisar'])) {
    $nomePesquisa = $_POST['nomePesquisa'];
    // Consulta SQL para selecionar funcionários com o nome semelhante ao termo de pesquisa
    $sql = "SELECT * FROM pedido WHERE situacao LIKE '%$nomePesquisa%'";

    $result = $pdo->query($sql);
    if($result->rowCount() == 0){
        $sql = "SELECT * FROM pedido WHERE rg LIKE '%$nomePesquisa%'";

        $result = $pdo->query($sql);
        if($result->rowCount()==0){
            $sql = "SELECT * FROM pedido WHERE data LIKE '%$nomePesquisa%'";
        }

    }

}
else{ $sql = "SELECT * FROM pedido";

}


$result = $pdo->query($sql);

if ($result) {



?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <title>Página Inicial - Ambiente Logado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
       <link rel="stylesheet" href="styleIndex.css">
    </head>
<style>
    .container{
     margin-top: 100px;
    }
</style>
    <body>
    <header>
    <?=template_header('Visualizar Pedidos')?>
    </header>
    <form action="Pedidos.php" method="post">
<div class="pesquisa">
    <Label>
        <h4>Pesquise:</h4>
    </Label>
    <input name="nomePesquisa" type="text">
    <button type="submit" name="pesquisar">Pesquisar</button>
</div>
</form>
        <!-- Aqui que será montada a tabela com a relação de anúncios!! -->
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Situacao</th>
                        <th scope="col">data</th>
                        <th scope="col">total</th>
                        <th scope="col">rg</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($pedido = $result->fetch(PDO::FETCH_ASSOC)) {
                        // Loop sobre os funcionários e exibir cada um em uma linha da tabela
                    ?>
                        <tr>
                            <th scope="row"><?php echo $pedido['numero']; ?></th>  
                            <td><?php echo $pedido['situacao']; ?></td>
                            <td><?php echo $pedido['data']; ?></td>
                            <td><?php echo $pedido['total']; ?></td>
                            <td><?php echo $pedido['rg']; ?></td>
                            <td>
                            <a href="alt_anuncio.php?id_anuncio=<?php echo $a['id']; ?>" class="btn btn-warning">Alterar</a>
                            <a href="del_anuncio.php?id_anuncio=<?php echo $a['id']; ?>" class="btn btn-danger">Excluir</a>
                     </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php  } ?>
    </body>

    </html>