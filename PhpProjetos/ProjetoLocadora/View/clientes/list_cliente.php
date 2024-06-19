<?php
include '../../Connection/conectaBD.php';

$sql = "SELECT * FROM clientes";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <a href="cad_cliente.php">Adicionar Cliente</a>
    <table border="1">
        <tr>
            <th>CNH</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Sobrenome</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Pagamento</th>
            <th>Cidade</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= htmlspecialchars($cliente['cnh']) ?></td>
                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                <td><?= htmlspecialchars($cliente['sobrenome']) ?></td>
                <td><?= htmlspecialchars($cliente['celular']) ?></td>
                <td><?= htmlspecialchars($cliente['email']) ?></td>
                <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                <td><?= htmlspecialchars($cliente['id_pagamento']) ?></td>
                <td><?= htmlspecialchars($cliente['cidade']) ?></td>
                <td>
                    <a href="update.php?cnh=<?= $cliente['cnh'] ?>">Editar</a>
                    <a href="delete.php?cnh=<?= $cliente['cnh'] ?>" onclick="return confirm('Tem certeza que deseja deletar este cliente?')">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>