<?php
// alocacao.php
include_once "../Connection/conectaBD.php";
// Inicializa as variáveis de data com valores padrão vazios
$data_alocacao = '';
$data_devolucao = '';

// Verifica se as datas foram enviadas via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_alocacao = $_POST['data_alocacao'] ?? '';
    $data_devolucao = $_POST['data_devolucao'] ?? '';
}

// Verifica se a placa do carro foi enviada via GET
if (isset($_GET['placa'])) {
    $placa = $_GET['placa'];

    // Consulta SQL para buscar informações do carro específico
    $sql = "SELECT modelo FROM carros WHERE placa = :placa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':placa', $placa);
    $stmt->execute();
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o carro foi encontrado
    if ($carro) {
        $modelo = htmlspecialchars($carro['modelo']);
    } else {
        $modelo = 'Carro não encontrado';
    }
} else {
    // Se não foi recebida a placa do carro, define como vazio
    $placa = '';
    $modelo = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Carros - Alocar Carro</title>
    <link rel="stylesheet" href="/View/css/alocacao.css"> <!-- Inclua seu arquivo CSS de estilo -->
</head>
<body>
<?php include './fragmentos/hearder.php'; ?>
<?=template_header('Header')?>
<div class="main-container">
    <h1>Alocar Carro</h1>
    
    <form action="../Connection/processar_aluguel.php" method="post">
        <label for="carro">Escolha um carro:</label>
        <select id="carro" name="placa" required>
            <option value="<?php echo htmlspecialchars($placa); ?>" selected><?php echo htmlspecialchars($modelo)?>  - <?php echo htmlspecialchars($placa)?></option>
            <?php
            include_once "../Connection/conectaBD.php";

            // Consulta SQL para buscar carros disponíveis
            $sql = "SELECT placa, modelo FROM carros WHERE disponibilidade = 'Disponível'";
            $stmt = $pdo->query($sql);

            // Loop para exibir as opções de carros
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $placa_option = htmlspecialchars($row['placa']);
                $modelo_option = htmlspecialchars($row['modelo']);
                // Exclui o carro já escolhido da lista de opções
                if ($placa_option !== $placa) {
                    echo "<option value='$placa_option'>$modelo_option - $placa_option</option>";
                }
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
