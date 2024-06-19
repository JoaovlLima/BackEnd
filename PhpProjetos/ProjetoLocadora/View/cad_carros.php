<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <link rel="stylesheet" href="/View/css/carros.css">
</head>
<body>
    <?php include './fragmentos/hearder.php'; ?>
    <?=template_header('Header')?>

    <div class="main-container">
        <h1>Cadastro de Carros</h1>
        <form action="../../Connection/processa_carros.php" method="post" enctype="multipart/form-data">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required><br>

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" required><br>

            <label for="preco_dia">Preço por Dia:</label>
            <input type="number" id="preco_dia" name="preco_dia" required><br>

            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" required><br>

            <label for="disponibilidade">Disponibilidade:</label>
            <select id="disponibilidade" name="disponibilidade" required>
                <option value="Disponivel">Disponível</option>
                <option value="Indisponivel">Indisponível</option>
            </select><br>
            
            <label for="agencia">Agencia:</label>
            <input type="number" id="agencia" name="agencia" required><br>

            <label for="img">Imagem:</label>
            <input type="file" id="img" name="img" accept="image/*"><br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
