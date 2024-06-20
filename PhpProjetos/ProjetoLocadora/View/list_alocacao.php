<?php
include '../Connection/conectaBD.php';

// Verifica se foi enviado algum filtro
$whereClauses = [];
$params = [];

// Filtros de alocacao
if (!empty($_GET['cnh'])) {
    $whereClauses[] = 'alocacao.cnh = :cnh';
    $params[':cnh'] = $_GET['cnh'];
}
if (!empty($_GET['placa'])) {
    $whereClauses[] = 'alocacao.placa = :placa';
    $params[':placa'] = $_GET['placa'];
}
if (!empty($_GET['data_alocacao'])) {
    $whereClauses[] = 'alocacao.data_alocacao = :data_alocacao';
    $params[':data_alocacao'] = $_GET['data_alocacao'];
}
if (!empty($_GET['data_entrega'])) {
    $whereClauses[] = 'alocacao.data_entrega = :data_entrega';
    $params[':data_entrega'] = $_GET['data_entrega'];
}

// Filtros de carros
if (!empty($_GET['ano'])) {
    $whereClauses[] = 'carros.ano = :ano';
    $params[':ano'] = $_GET['ano'];
}
if (!empty($_GET['modelo'])) {
    $whereClauses[] = 'carros.modelo LIKE :modelo';
    $params[':modelo'] = '%' . $_GET['modelo'] . '%';
}
if (!empty($_GET['tipo'])) {
    $whereClauses[] = 'carros.tipo LIKE :tipo';
    $params[':tipo'] = '%' . $_GET['tipo'] . '%';
}
if (!empty($_GET['disponibilidade'])) {
    $whereClauses[] = 'carros.disponibilidade LIKE :disponibilidade';
    $params[':disponibilidade'] = '%' . $_GET['disponibilidade'] . '%';
}
if (!empty($_GET['preco_dia'])) {
    $whereClauses[] = 'carros.preco_dia = :preco_dia';
    $params[':preco_dia'] = $_GET['preco_dia'];
}

// Filtros de clientes
if (!empty($_GET['nome'])) {
    $whereClauses[] = 'clientes.nome LIKE :nome';
    $params[':nome'] = '%' . $_GET['nome'] . '%';
}
if (!empty($_GET['sobrenome'])) {
    $whereClauses[] = 'clientes.sobrenome LIKE :sobrenome';
    $params[':sobrenome'] = '%' . $_GET['sobrenome'] . '%';
}
if (!empty($_GET['telefone'])) {
    $whereClauses[] = 'clientes.telefone LIKE :telefone';
    $params[':telefone'] = '%' . $_GET['telefone'] . '%';
}
if (!empty($_GET['celular'])) {
    $whereClauses[] = 'clientes.celular LIKE :celular';
    $params[':celular'] = '%' . $_GET['celular'] . '%';
}
if (!empty($_GET['email'])) {
    $whereClauses[] = 'clientes.email LIKE :email';
    $params[':email'] = '%' . $_GET['email'] . '%';
}
if (!empty($_GET['endereco'])) {
    $whereClauses[] = 'clientes.endereco LIKE :endereco';
    $params[':endereco'] = '%' . $_GET['endereco'] . '%';
}
if (!empty($_GET['id_pagamento'])) {
    $whereClauses[] = 'clientes.id_pagamento = :id_pagamento';
    $params[':id_pagamento'] = $_GET['id_pagamento'];
}
if (!empty($_GET['cidade'])) {
    $whereClauses[] = 'clientes.cidade LIKE :cidade';
    $params[':cidade'] = '%' . $_GET['cidade'] . '%';
}

$sql = "SELECT alocacao.*, carros.modelo, carros.tipo, carros.disponibilidade, carros.ano, carros.preco_dia, carros.img, 
        clientes.nome, clientes.sobrenome, clientes.email, clientes.cidade, clientes.telefone, clientes.celular, clientes.endereco, clientes.id_pagamento 
        FROM alocacao 
        INNER JOIN carros ON alocacao.placa = carros.placa 
        INNER JOIN clientes ON alocacao.cnh = clientes.cnh";

if (!empty($whereClauses)) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$locacoes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Locações</title>
    <link rel="stylesheet" href="/View/css/list_alocacao.css">
</head>
<body>
    <h1>Lista de Locações</h1>
    <form method="get" action="list_alocacao.php">
    <fieldset>
            <legend>Alocação</legend>
            <label for="cnh">CNH:</label>
            <input type="text" id="cnh" name="cnh" value="<?= htmlspecialchars($_GET['cnh'] ?? '') ?>"><br>
            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" value="<?= htmlspecialchars($_GET['placa'] ?? '') ?>"><br>
            <label for="data_alocacao">Data de Alocação:</label>
            <input type="date" id="data_alocacao" name="data_alocacao" value="<?= htmlspecialchars($_GET['data_alocacao'] ?? '') ?>"><br>
            <label for="data_entrega">Data de Entrega:</label>
            <input type="date" id="data_entrega" name="data_entrega" value="<?= htmlspecialchars($_GET['data_entrega'] ?? '') ?>"><br>
        </fieldset>

        <fieldset>
            <legend>Carros</legend>
            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" value="<?= htmlspecialchars($_GET['ano'] ?? '') ?>"><br>
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($_GET['modelo'] ?? '') ?>"><br>
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($_GET['tipo'] ?? '') ?>"><br>
            <label for="disponibilidade">Disponibilidade:</label>
            <input type="text" id="disponibilidade" name="disponibilidade" value="<?= htmlspecialchars($_GET['disponibilidade'] ?? '') ?>"><br>
            <label for="preco_dia">Preço por Dia:</label>
            <input type="number" step="0.01" id="preco_dia" name="preco_dia" value="<?= htmlspecialchars($_GET['preco_dia'] ?? '') ?>"><br>
        </fieldset>

        <fieldset>
            <legend>Clientes</legend>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>"><br>
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" value="<?= htmlspecialchars($_GET['sobrenome'] ?? '') ?>"><br>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($_GET['telefone'] ?? '') ?>"><br>
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" value="<?= htmlspecialchars($_GET['celular'] ?? '') ?>"><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>"><br>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($_GET['endereco'] ?? '') ?>"><br>
            <label for="id_pagamento">ID Pagamento:</label>
            <input type="number" id="id_pagamento" name="id_pagamento" value="<?= htmlspecialchars($_GET['id_pagamento'] ?? '') ?>"><br>
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($_GET['cidade'] ?? '') ?>"><br>
        </fieldset>

    </form>
    <table border="1">
        <tr>
            <th>ID Locação</th>
            <th>Data de Alocação</th>
            <th>Data de Entrega</th>
            <th>Valor Total</th>
            <th>CNH</th>
            <th>Placa</th>
       
        </tr>
        <?php foreach ($locacoes as $locacao): ?>
            <tr>
                <td><?= htmlspecialchars($locacao['id_locacao']) ?></td>
                <td><?= htmlspecialchars($locacao['data_alocacao']) ?></td>
                <td><?= htmlspecialchars($locacao['data_entrega']) ?></td>
                <td><?= htmlspecialchars($locacao['valor_total']) ?></td>
                <td><?= htmlspecialchars($locacao['cnh']) ?></td>
                <td><?= htmlspecialchars($locacao['placa']) ?></td>
             
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
