<?php
include '../../../Connection/conectaBD.php';

$sql = "SELECT f.*, a.cidade as agencia_cidade 
        FROM funcionario f
        INNER JOIN agencias a ON f.numero_da_agencia = a.numero_da_agencia";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Funcionários</title>
</head>
<body>
    <h1>Lista de Funcionários</h1>
    <table border="1">
        <tr>
            <th>RE</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Salário</th>
            <th>Data de Contratação</th>
            <th>Cargo</th>
            <th>Número da Agência</th>
            <th>Cidade</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($funcionarios as $funcionario): ?>
            <tr>
                <td><?= htmlspecialchars($funcionario['re']) ?></td>
                <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                <td><?= htmlspecialchars($funcionario['sobrenome']) ?></td>
                <td><?= htmlspecialchars($funcionario['salario']) ?></td>
                <td><?= htmlspecialchars($funcionario['data_contratacao']) ?></td>
                <td><?= htmlspecialchars($funcionario['cargo']) ?></td>
                <td><?= htmlspecialchars($funcionario['numero_da_agencia']) ?></td>
                <td><?= htmlspecialchars($funcionario['agencia_cidade']) ?></td>
                <td>
                    <a href="../funcionarios/editar_funcionario.php?re=<?= $funcionario['re'] ?>">Editar</a>
                    <a href="../../../Connection/delete_funcionario.php?re=<?= $funcionario['re'] ?>" onclick="return confirm('Tem certeza que deseja deletar este funcionário?')">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../funcionarios/cad_funcionario.php">Adicionar Funcionário</a>
</body>
</html>
