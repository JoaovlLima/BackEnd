<?php
include '../../../Connection/conectaBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $salario = $_POST['salario'];
    $data_contratacao = $_POST['data_contratacao'];
    $cargo = $_POST['cargo'];
    $numero_da_agencia = $_POST['numero_da_agencia'];
    $cidade = $_POST['cidade'];
    $re = $_POST['re'];

    $sql = "INSERT INTO funcionario (re,nome, sobrenome, salario, data_contratacao, cargo, numero_da_agencia, cidade) 
            VALUES (:re,:nome, :sobrenome, :salario, :data_contratacao, :cargo, :numero_da_agencia, :cidade)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':re' => $re,
        ':nome' => $nome,
        ':sobrenome' => $sobrenome,
        ':salario' => $salario,
        ':data_contratacao' => $data_contratacao,
        ':cargo' => $cargo,
        ':numero_da_agencia' => $numero_da_agencia,
        ':cidade' => $cidade
    ]);
    echo "Funcionário adicionado com sucesso!";
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Funcionário</title>
</head>
<body>
    <h1>Adicionar Funcionário</h1>
    <form method="post" action="cad_funcionario.php">
        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Sobrenome: <input type="text" name="sobrenome" required></label><br>
        <label>Salário: <input type="text" name="salario" required></label><br>
        <label>Data de Contratação: <input type="date" name="data_contratacao" required></label><br>
        <label>Cargo: <input type="text" name="cargo" required></label><br>
        <label>Número da Agência: <input type="number" name="numero_da_agencia" required></label><br>
        <label>Cidade: <input type="text" name="cidade" required></label><br>
        <label>RE: <input type="text" name="re" required></label><br>

        <button type="submit">Adicionar</button>
    </form>
    <a href="../funcionarios/list_funcionarios.php">Ver Funcionários</a>
</body>
</html>
