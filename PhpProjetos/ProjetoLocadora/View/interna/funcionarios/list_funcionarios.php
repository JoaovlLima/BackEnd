<?php
include '../../../Connection/conectaBD.php';

// Inicializa a variável de pesquisa
$pesquisa = '';

// Atualiza a variável de pesquisa com o valor do formulário, se existir
if (isset($_GET['pesquisa'])) {
    $pesquisa = $_GET['pesquisa'];
}

// Constrói a consulta SQL com a pesquisa
$sql = "SELECT f.*, a.cidade as agencia_cidade 
        FROM funcionario f
        INNER JOIN agencias a ON f.numero_da_agencia = a.numero_da_agencia
        WHERE 1=1";

if (!empty($pesquisa)) {
    $sql .= " AND (f.re LIKE :pesquisa 
                   OR f.nome LIKE :pesquisa 
                   OR f.sobrenome LIKE :pesquisa 
                   OR f.salario::text LIKE :pesquisa
                   OR f.cargo LIKE :pesquisa 
                   OR f.numero_da_agencia::text LIKE :pesquisa 
                   OR a.cidade LIKE :pesquisa)";
}

$stmt = $pdo->prepare($sql);

if (!empty($pesquisa)) {
    $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%', PDO::PARAM_STR);
}

$stmt->execute();
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

    <!-- Formulário de pesquisa -->
    <form method="get" action="">
        <label for="pesquisa">Pesquisar:</label>
        <input type="text" id="pesquisa" name="pesquisa" value="<?= htmlspecialchars($pesquisa) ?>"><br>
        <button type="submit">Pesquisar</button>
    </form>

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
