<?php
include '../../Connection/conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cnh'])) {
    $cnh = $_GET['cnh'];

    $sql = "SELECT * FROM clientes WHERE cnh = :cnh";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cnh', $cnh, PDO::PARAM_STR);
    $stmt->execute();
    $cliente = $stmt->fetch();

    if (!$cliente) {
        echo "Cliente não encontrado.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cnh'])) {
    $cnh = $_POST['cnh'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $sobrenome = $_POST['sobrenome'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $id_pagamento = $_POST['id_pagamento'];
    $cidade = $_POST['cidade'];

    $sql = "UPDATE clientes 
            SET nome = :nome, telefone = :telefone, sobrenome = :sobrenome, celular = :celular, email = :email, endereco = :endereco, id_pagamento = :id_pagamento, cidade = :cidade
            WHERE cnh = :cnh";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cnh' => $cnh,
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':sobrenome' => $sobrenome,
        ':celular' => $celular,
        ':email' => $email,
        ':endereco' => $endereco,
        ':id_pagamento' => $id_pagamento,
        ':cidade' => $cidade
    ]);

    header("Location: ../View/index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="cnh" value="<?= htmlspecialchars($cliente['cnh']) ?>">
        
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required><br>
        
        <label for="sobrenome">Sobrenome:</label>
        <input type="text
