<?php
include '../../../Connection/conectaBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['re'])) {
    $re = $_GET['re'];

    $sql = "SELECT * FROM funcionario WHERE re = :re";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':re' => $re]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['re'])) {
    $re = $_POST['re'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $salario = $_POST['salario'];
    $data_contratacao = $_POST['data_contratacao'];
    $cargo = $_POST['cargo'];
    $numero_da_agencia = $_POST['numero_da_agencia'];
    $cidade = $_POST['cidade'];

    $sql = "UPDATE funcionario SET 
            nome = :nome,
            sobrenome = :sobrenome,
            salario = :salario,
            data_contratacao = :data_contratacao,
            cargo = :cargo,
            numero_da_agencia = :numero_da_agencia,
            cidade = :cidade
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':sobrenome' => $sobrenome,
        ':salario' => $salario,
        ':data_contratacao' => $data_contratacao,
        ':cargo' => $cargo,
        ':numero_da_agencia' => $numero_da_agencia,
        ':cidade' => $cidade,
        ':re' => $re
    ]);
    echo "Funcionário atualizado com sucesso!";
    header('Location: read.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Funcionário</title>
</head>
<body>
    <h1>Atualizar Funcionário</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($funcionario['re']) ?>">
        <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($funcionario['nome']) ?>" required></label><br>
        <label>Sobrenome: <input type="text" name="sobrenome" value="<?= htmlspecialchars($funcionario['sobrenome']) ?>" required></label><br>
        <label>Salário: <input type="text" name="salario" value="<?= htmlspecialchars($funcionario['salario']) ?>" required></label><br>
        <label>Data de Contratação: <input type="date" name="data_contratacao" value="<?= htmlspecialchars($funcionario['data_contratacao']) ?>" required></label><br>
        <label>Cargo: <input type="text" name="cargo" value="<?= htmlspecialchars($funcionario['cargo']) ?>" required></label><br>
        <label>Número da Agência: <input type="number" name="numero_da_agencia" value="<?= htmlspecialchars($funcionario['numero_da_agencia']) ?>" required></label><br>
        <label>Cidade: <input type="text" name="cidade" value="<?= htmlspecialchars($funcionario['cidade']) ?>" required></label><br>
        <button type="submit">Atualizar</button>
    </form>
    <a href="../funcionarios/list_funcionarios.php">Voltar</a>
</body>
</html>
