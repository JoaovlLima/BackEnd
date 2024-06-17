<?php
// Verifica se os dados foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $placa = $_POST['placa'];
    $cnh = $_POST['cnh'];
    $data_inicio = $_POST['data_inicio'];
    $data_entrega = $_POST['data_entrega'];

    // Inclui o arquivo de conexão com o banco de dados
    include_once("conectaBD.php");

    // Calcula o valor total do aluguel
    $valor_total = calcularValorTotal($placa, $data_inicio, $data_entrega, $pdo);
   
    // Prepara a SQL para inserção na tabela 'alocacao'
    $sql = "INSERT INTO alocacao (id_locacao,data_alocacao, data_entrega, valor_total, placa, cnh, re)
            VALUES (32,:data_inicio, :data_entrega, :valor_total, :placa, :cnh, :re)";
    
    // Prepara e executa a query
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_inicio', $data_inicio);
    $stmt->bindParam(':data_entrega', $data_entrega);
    $stmt->bindParam(':valor_total', $valor_total);
    $stmt->bindParam(':placa', $placa);
    $stmt->bindParam(':cnh', $cnh);

    // Define um valor padrão para 're' (ajuste conforme sua necessidade)
    $re = "re"; // Exemplo: um valor que faça sentido para 're'
    $stmt->bindParam(':re', $re);

    // Verifica se a execução foi bem-sucedida
    if ($stmt->execute()) {
        echo "Aluguel registrado com sucesso!";
    } else {
        echo "Erro ao registrar o aluguel.";
    }
}

// Função para calcular o valor total do aluguel
function calcularValorTotal($placa, $data_inicio, $data_entrega, $pdo) {
    try {
        // Consulta SQL para obter o preço do carro por dia
        $sql = "SELECT preco_dia FROM carros WHERE placa = :placa";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':placa', $placa);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new Exception("Carro não encontrado.");
        }

        $preco_dia = (float) $row['preco_dia']; // Converte para float

        // Calcula o número de dias entre a data de início e a data de entrega
        $datetime1 = new DateTime($data_inicio);
        $datetime2 = new DateTime($data_entrega);
        $interval = $datetime1->diff($datetime2);
        $numero_dias = $interval->days + 1; // +1 porque inclui o primeiro dia

        // Calcula o valor total
        $valor_total = $preco_dia * $numero_dias;

        return $valor_total;

    } catch (Exception $e) {
        echo "Erro ao calcular o valor total: " . $e->getMessage();
        return 0; // Retorna 0 em caso de erro
    }
}
?>
