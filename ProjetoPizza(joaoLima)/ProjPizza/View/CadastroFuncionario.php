<?php
include_once('../templates/hearder.php');

// Verifica se o formulário foi enviado

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleIndex.css">
    <link rel="stylesheet" href="styleCadFun.css">
</head>
<body>
<header>
<?=template_header('Visualizar Pedidos')?>
    </header>
    <div class="container">
        <h2>Cadastro de Funcionário</h2>
        <form action="../Connection/Cad_Fun.php" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="text" class="form-control" id="salario" name="salario" required>
            </div>
            <div class="form-group">
                <label for="re">RE:</label>
                <input type="text" class="form-control" id="id_funcionario" name="id_funcionario" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>