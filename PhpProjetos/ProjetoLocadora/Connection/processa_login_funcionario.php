<?php
// Inicia a sessão
session_start();

// Conexão com o banco de dados
include_once("conectaBD.php");

// Verifica se os dados foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $re = $_POST['re'];

    try {
        // Consulta SQL para verificar o funcionário pelo RE
        $sql = "SELECT nome, sobrenome, cargo FROM funcionario WHERE re = :re";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':re', $re, PDO::PARAM_STR);
        $stmt->execute();
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o funcionário existe e se é vendedor ou gerente
        if ($funcionario) {
            $cargo = $funcionario['cargo'];
            if ($cargo == 'Vendedor' || $cargo == 'Gerente') {
                // Armazena os dados do funcionário na sessão
                $_SESSION['funcionario'] = [
                    'nome' => htmlspecialchars($funcionario['nome']),
                    'sobrenome' => htmlspecialchars($funcionario['sobrenome']),
                    're' => htmlspecialchars($re),
                    'cargo' => ucfirst($cargo)
                ];

                // Redireciona para a página principal após o login bem-sucedido
                header('Location: ../View/index.php');
                exit(); // Encerra o script após o redirecionamento
            } else {
                echo "Apenas vendedores e gerentes podem fazer login.<br>";
            }
        } else {
            echo "Funcionário não encontrado.<br>";
        }
    } catch (PDOException $e) {
        echo "Erro ao tentar realizar o login: " . $e->getMessage();
    }
}
?>
