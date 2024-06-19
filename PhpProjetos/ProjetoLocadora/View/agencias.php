<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Agências</title>
    <link rel="stylesheet" href="/caminho/para/seu/css/style.css">
</head>
<body>
    <?php include './fragmentos/hearder.php'; ?>
    <?=template_header('Header')?>

    <div class="main-container">
        <h1>Listagem de Agências</h1>

        <!-- Formulário de Filtros -->
        <form method="get">
            <label for="filtro_cidade">Filtrar por Cidade:</label>
            <input type="text" id="filtro_cidade" name="cidade" value="<?=isset($_GET['cidade']) ? htmlspecialchars($_GET['cidade']) : ''?>">
            <button type="submit">Filtrar</button>
        </form>

        <div class="agencias-list">
            <?php
            // Inclui o arquivo de conexão com o banco de dados
            include_once("../Connection/conectaBD.php");

            // Constrói a consulta SQL base
            $sql = "SELECT a.numero_da_agencia, a.cidade, COUNT(*) AS carros_disponiveis
                    FROM agencias a
                    INNER JOIN pertence p ON a.numero_da_agencia = p.numero_da_agencia
                    INNER JOIN carros c ON p.placa = c.placa
                    WHERE c.disponibilidade = 'Disponivel'";

            // Verifica se foi enviado um filtro de cidade
            if (isset($_GET['cidade']) && !empty($_GET['cidade'])) {
                $cidade = $_GET['cidade'];
                $sql .= " AND a.cidade LIKE :cidade";
            } else {
                $cidade = '';
            }

            $sql .= " GROUP BY a.numero_da_agencia, a.cidade";

            // Prepara a consulta
            $stmt = $pdo->prepare($sql);

            // Define o parâmetro de cidade se existir
            if (!empty($cidade)) {
                $stmt->bindValue(':cidade', '%' . $cidade . '%', PDO::PARAM_STR);
            }

            // Executa a consulta
            $stmt->execute();

            // Verifica se há agências no resultado
            if ($stmt->rowCount() > 0) {
                // Loop para exibir as agências em cards
                while ($agencia = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $numero_da_agencia = htmlspecialchars($agencia['numero_da_agencia']);
                    $cidade = htmlspecialchars($agencia['cidade']);
                    $carros_disponiveis = intval($agencia['carros_disponiveis']);

                    // Exibe o card da agência
                    echo "<div class='agencia-card'>";
                    echo "<h2>$numero_da_agencia</h2>";
                    echo "<p>Cidade: $cidade</p>";
                    echo "<p>Carros Disponíveis: $carros_disponiveis</p>";
                    echo "<a href='detalhes_agencia.php?agencia=$numero_da_agencia'>Ver Detalhes</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma agência encontrada.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
