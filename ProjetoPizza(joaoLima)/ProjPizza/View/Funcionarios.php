<?php

use LDAP\Result;

require_once 'F:\Arquivos\Lição\PROGRAMACAO\2024\BackEnd\PhpProjetos\ProjetoPizza(joaoLima)\ProjPizza\Connection/conectabd.php';
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
    $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$nomePesquisa%'";

    $result = $pdo->query($sql);
    if($result->rowCount() == 0){
        $sql = "SELECT * FROM funcionarios WHERE cargo LIKE '%$nomePesquisa%'";

        $result = $pdo->query($sql);
        if($result->rowCount()==0){
            $sql = "SELECT * FROM funcionarios WHERE salario LIKE '%$nomePesquisa%'";
        }

    }

}
else{ $sql = "SELECT * FROM funcionarios";

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
        <div class="left-section">
            <img src="../img/iconCasa.png" alt="Home Icon">
            <a href="/View/index.php">Home</a>
            
            <img src="../img/iconCardapio.png" alt="Menu Icon">
            <a href="#">Cardápio</a>
            <a href="/View/Funcionarios.php">funcionario</a>
        </div>
        <img src="../img/imgFundo-.png" alt="Logo" class="logo">
        <div class="right-section">
            <a href="#">Meu Perfil</a>
            <img src="../img/imgPerfil.png" alt="Profile Icon">
        </div>
    </header>
    <form action="Funcionarios.php" method="post">
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
                        <th scope="col">Salario</th>
                        <th scope="col">nome</th>
                        <th scope="col">cargo</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($funcionario = $result->fetch(PDO::FETCH_ASSOC)) {
                        // Loop sobre os funcionários e exibir cada um em uma linha da tabela
                    ?>
                        <tr>
                            <th scope="row"><?php echo $funcionario['id_funcionario']; ?></th>  
                            <td><?php echo $funcionario['nome']; ?></td>
                            <td><?php echo $funcionario['cargo']; ?></td>
                            <td><?php echo $funcionario['salario']; ?></td>
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