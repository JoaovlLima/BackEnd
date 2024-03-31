
<?php
require_once 'conectabd.php';

//session_start();

//if (empty($_SESSION)) {
 //   header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
 //   die();
//}

if (!empty($_POST)) {
    // CADASTRAR!!!
        try {
            // Montar a SQL para inserção
            $sql = "INSERT INTO funcionarios (nome, cargo, salario, id_funcionario) VALUES (:nome, :cargo, :salario, :id_funcionario)";
            
            // Preparar a SQL
            $stmt = $pdo->prepare($sql);
            
            // Definir/organizar os dados para a SQL
            $dados = array(
                ':nome' => $_POST['nome'],
                ':cargo' => $_POST['cargo'],
                ':salario' => $_POST['salario'],
                ':id_funcionario' => $_POST['id_funcionario']
            );

            // Tentar executar a SQL (INSERT)
            if ($stmt->execute($dados)) {
                header("Location: ../View/index.php?msgSucesso=Funcionário cadastrado com sucesso!");
            } else {
                header("Location: ../View/index.php?msgErro=Falha ao cadastrar funcionário.");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
            header("Location: ../View/index.php?msgErro=Falha ao cadastrar funcionário.");
        }
    
    }
 else {
    header("Location: ../View/index.php?msgErro=Erro de acesso.");
}
?>
