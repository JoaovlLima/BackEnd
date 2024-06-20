<?php
include '../../Connection/conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cnh = $_POST['cnh'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $sobrenome = $_POST['sobrenome'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $id_pagamento = $_POST['id_pagamento'];
    $cidade = $_POST['cidade'];

    $sql = "INSERT INTO clientes (cnh, nome, telefone, sobrenome, celular, email, endereco, id_pagamento, cidade) 
            VALUES (:cnh, :nome, :telefone, :sobrenome, :celular, :email, :endereco, :id_pagamento, :cidade)";
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

    header("Location: ./View/clientes/list_cliente.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cliente</title>
</head>
<body>
    <h1>Adicionar Cliente</h1>
    <form action="cad_cliente.php" method="post">
        <label for="cnh">CNH:</label>
        <input type="text" id="cnh" name="cnh" required><br>
        
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>
        
        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome" required><br>
        
        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br>
        
        <label for="id_pagamento">ID Pagamento:</label>
        <input type="number" id="id_pagamento" name="id_pagamento" ><br>
        
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>
        
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
