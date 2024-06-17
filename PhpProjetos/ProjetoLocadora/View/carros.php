<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/View/css/carros.css">
    <script>
        // Função para manter a seleção no dropdown após o envio do formulário
        document.addEventListener('DOMContentLoaded', function() {
            let cidadeSelecionada = "<?php echo isset($_POST['cidade']) ? $_POST['cidade'] : '' ?>";
            document.getElementById('cidades').value = cidadeSelecionada;
        });
    </script>
</head>
<body>

<?php include './fragmentos/hearder.php'; ?>
<?=template_header('Header')?>
<div class="main-container">
    <div class="header-container">
        <h1>Listagem de Carros</h1>
        <form id="filtroForm" method="post">
            <label for="cidades">Cidades: </label>
            <select id="cidades" name="cidade" class="city-select" onchange="this.form.submit()">
                <?php
                include_once("../Connection/conectaBD.php");

                // Consulta SQL para buscar todas as cidades da tabela agencias
                $sql = "SELECT DISTINCT cidade FROM agencias";
                $stmt = $pdo->query($sql);

                // Verifica se há cidades no resultado
                if ($stmt->rowCount() > 0) {
                    echo "<option value='todos'>Selecione uma cidade</option>";
                    // Loop para exibir as cidades na caixa de seleção
                    while ($agencia = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $cidade = htmlspecialchars($agencia['cidade']);
                        $selected = (isset($_POST['cidade']) && $_POST['cidade'] === $cidade) ? 'selected' : '';
                        echo "<option value='$cidade' $selected>$cidade</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma cidade encontrada</option>";
                }
                ?>
            </select>
        </form>
    </div>
    <div class="car-list" id="car-list">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se foi enviado um valor válido para 'cidade'
            if (isset($_POST['cidade']) && !empty($_POST['cidade'])) {
                $cidade = $_POST['cidade'];

                // Verifica se a opção "todos" foi selecionada
                if ($cidade == 'todos') {
                    $sql = "SELECT *
                            FROM carros";
                } else {
                    // Consulta SQL para buscar os carros disponíveis na cidade selecionada
                    $sql = "SELECT c.modelo, c.tipo, c.ano, c.img, c.placa 
                            FROM carros c
                            INNER JOIN pertence p ON c.placa = p.placa
                            INNER JOIN agencias a ON p.numero_da_agencia = a.numero_da_agencia
                            WHERE a.cidade = :cidade";
                }

                $stmt = $pdo->prepare($sql);
                if ($cidade != 'todos') {
                    $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
                }
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
                        echo "<form action='alocacao.php' method='get'>";
                        echo "<input type='hidden' name='placa' value='$placa'>";
                        echo "<button type='submit' class='botao-personalizado'>Comprar</button>";
                        echo "</form>";
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
                echo "<p>Selecione uma cidade para ver os carros disponíveis.</p>";
            }
        } else {
            echo "<p>Selecione uma cidade para ver os carros disponíveis.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
