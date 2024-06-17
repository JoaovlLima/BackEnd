<?php
// alocacao.php

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário do cabeçalho
    $cidade = $_POST['cidade'] ?? '';
    $data_alocacao = $_POST['data_alocacao'] ?? '';
    $data_devolucao = $_POST['data_devolucao'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Carros - Alocar Carro</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Estilo CSS, ajuste conforme necessário -->
</head>
<body>

<div class="container">
    <h1>Alocar Carro</h1>
    
    <form action="../Connection/processar_aluguel.php" method="post">
        <label for="carro">Escolha um carro:</label>
        <select id="carro" name="placa" required>
            <option value="">Selecione um carro</option>
            <?php
            include_once "../Connection/conectaBD.php";

            // Consulta SQL para buscar carros disponíveis
            $sql = "SELECT placa, modelo FROM carros WHERE disponibilidade = 'Disponível'";
            $stmt = $pdo->query($sql);

            // Loop para exibir as opções de carros
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $placa = htmlspecialchars($row['placa']);
                $modelo = htmlspecialchars($row['modelo']);
                // Verifica se foi enviado um valor para placa e seleciona a opção correspondente
                $selected = ($_POST['placa'] == $placa) ? 'selected' : '';
                echo "<option value='$placa' $selected>$modelo - $placa</option>";
            }
            ?>
        </select>

        <label for="cnh">CNH do Cliente:</label>
        <input type="text" id="cnh" name="cnh" required>

        <label for="data_inicio">Data de Início:</label>
        <input type="date" id="data_inicio" name="data_inicio" value="<?php echo htmlspecialchars($data_alocacao); ?>" required>

        <label for="data_entrega">Data de Entrega:</label>
        <input type="date" id="data_entrega" name="data_entrega" value="<?php echo htmlspecialchars($data_devolucao); ?>" required>

        <button type="submit">Alugar Carro</button>
    </form>
</div>

</body>
</html>
