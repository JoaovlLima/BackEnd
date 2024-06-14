    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/View/css/carros.css">
    </head>
    <body>
    <?php include './fragmentos/hearder.php'; ?>
    <?=template_header('LocadoraHeader')?>
    <div class="main-container">
        <h1>Listagem de Carros</h1>
        <div class="car-list">
            <?php
            include_once("../Connection/conectaBD.php");

            // Consulta SQL para buscar todos os carros
            $sql = "SELECT modelo, tipo, ano, img, placa FROM Carros";
            $stmt = $pdo->query($sql);

            // Verifica se há carros no resultado
            if ($stmt->rowCount() > 0) {
                // Loop para exibir os carros no carrossel
                while ($carro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $modelo = htmlspecialchars($carro['modelo']);
                    $tipo = htmlspecialchars($carro['tipo']);
                    $ano = intval($carro['ano']);
                    $img = htmlspecialchars($carro['img']);
                    $placa = htmlspecialchars($carro['placa']);

                    // Exibir o card com os detalhes do carro
                    echo "<div class='carousel-card'>";
                    echo "<img src='./img/$img' alt='$modelo'>";
                    echo "<p>Modelo: $modelo</p>";
                    echo "<p>Tipo: $tipo</p>";
                    echo "<p>Ano: $ano</p>";
                    echo "<p><a href='detalhes.php?placa=$placa'>Ver detalhes</a></p>"; // Link para a página de detalhes
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum carro encontrado.</p>";
            }
            ?>
        </div>
        <button class="button">Confira todos os carros</button>
    </div>
    </body>
    </html>