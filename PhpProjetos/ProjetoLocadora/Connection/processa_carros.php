<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $ano = $_POST['ano'];
    $preco_dia = $_POST['preco_dia'];
    $placa = $_POST['placa'];
    $disponibilidade = $_POST['disponibilidade'];
    $agencia = $_POST['agencia'];

    // Tratamento do upload da imagem
    if (!empty($_FILES['img']['name'])){
    $img = $_FILES['img']['name'];
    $target_dir = "../../view/img/";
    $target_file = $target_dir . basename($img);
    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
    }
    else{
        $img = $modelo.".jpg";
    }

    // Inclui o arquivo de conexão com o banco de dados
    include_once("../Connection/conectaBD.php");

    try {
        // Inicia uma transação
        $pdo->beginTransaction();

        // Insere o carro na tabela 'carros'
        $sql_carro = "INSERT INTO carros (modelo, tipo, ano, preco_dia, placa, disponibilidade, img)
                      VALUES (:modelo, :tipo, :ano, :preco_dia, :placa, :disponibilidade, :img)";
        $stmt_carro = $pdo->prepare($sql_carro);
        $stmt_carro->bindParam(':modelo', $modelo);
        $stmt_carro->bindParam(':tipo', $tipo);
        $stmt_carro->bindParam(':ano', $ano);
        $stmt_carro->bindParam(':preco_dia', $preco_dia);
        $stmt_carro->bindParam(':placa', $placa);
        $stmt_carro->bindParam(':disponibilidade', $disponibilidade);
        $stmt_carro->bindParam(':img', $img);
        $stmt_carro->execute();

        // Obtém o ID do carro inserido
        

        // Insere a relação na tabela 'pertence'
        $sql_pertence = "INSERT INTO pertence (placa, numero_da_agencia) VALUES (:placa, :agencia)";
        $stmt_pertence = $pdo->prepare($sql_pertence);
        $stmt_pertence->bindParam(':placa', $placa);
        $stmt_pertence->bindParam(':agencia', $agencia);
        $stmt_pertence->execute();

        // Confirma a transação
        $pdo->commit();

        echo "Cadastro de carro realizado com sucesso.";

    } catch (PDOException $e) {
        // Rollback em caso de erro
        $pdo->rollback();
        echo "Erro ao cadastrar o carro: " . $e->getMessage();
    }
}
?>
