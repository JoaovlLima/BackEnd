<?php
include_once("conectaBD.php");

// Verifica se o parâmetro 'cidade' foi passado na requisição GET
if (isset($_GET['cidade'])) {
    $cidade = $_GET['cidade'];

    // Consulta SQL para buscar os carros disponíveis na cidade selecionada
    $sql = "SELECT c.modelo, c.tipo, c.ano, c.img, c.placa FROM carros c
            INNER JOIN pertence p ON c.placa = p.placa_carro
            INNER JOIN agencias a ON p.numero_agencia = a.numero
            WHERE a.cidade = :cidade";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
    $stmt->execute();

    // Verifica se há carros no resultado
    if ($stmt->rowCount() > 0) {
        // Loop para exibir os carros
        while ($carro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $modelo = htmlspecialchars($carro['modelo']);
            $tipo = htmlspecialchars($carro['tipo']);
            $ano = intval($carro['ano']);
            $img = htmlspecialchars($carro['img']);
            $placa = htmlspecialchars($carro['placa']);

            // Exibir o card com os detalhes do carro
            echo "<div class='carousel-card2' onclick='this.classList.toggle(\"flipped\")'>";
            echo "<div class='carousel-card2-inner'>";
            echo "<div class='carousel-card2-front'>";
            echo "<img src='./img/$img' alt='$modelo'>";
            echo "<p>Modelo: $modelo</p>";
            echo "<a href='index.php'><button class='botao-personalizado'>Comprar</button></a>"; // Botão adicionado
            echo "<p><a href='javascript:void(0)'>Ver detalhes</a></p>"; // Link para a página de detalhes
            echo "</div>";
            echo "<div class='carousel-card2-back'>";
            echo "<p>Tipo: $tipo</p>";
            echo "<p>Ano: $ano</p>";
            echo "<p>Placa: $placa</p>";
            echo "<p>Informações adicionais do carro.</p>";
            echo "<p><a href='javascript:void(0)' onclick='this.classList.toggle(\"flipped\")'>Esconder detalhes</a></p>"; // Link para voltar ao card da frente
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhum carro encontrado para esta cidade.</p>";
    }
} else {
    echo "<p>Parâmetro 'cidade' não foi especificado.</p>";
}
?>
