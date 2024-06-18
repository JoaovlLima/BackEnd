<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos CPF e senha foram enviados
    if (isset($_POST['cpf'], $_POST['senha'])) {
        echo "Campos CPF e senha foram recebidos via POST.<br>";

        // Recebe os dados do formulário
        $cpf = $_POST['cpf'];
        $senha_digitada = $_POST['senha'];

        // Verifica se os campos foram preenchidos
        if (!empty($cpf) && !empty($senha_digitada)) {
            echo "CPF e senha não estão vazios.<br>";
            try {
                // Conecta ao banco de dados
                include_once "conectaBD.php"; // Verifique o caminho do seu arquivo de conexão

                // Verifica se a conexão foi estabelecida corretamente
                if (!$pdo) {
                    throw new Exception("Erro ao conectar ao banco de dados.");
                }
                echo "Conexão com o banco de dados estabelecida.<br>";

                // Prepara a consulta SQL para buscar o admin pelo CPF
                $sql = "SELECT * FROM adm WHERE cpf = :cpf";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->execute();
                
                // Verifica se encontrou algum registro
                if ($stmt->rowCount() > 0) {
                    echo "Admin encontrado no banco de dados.<br>";
                    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Verifica se a senha digitada corresponde à senha no banco de dados
                    $senha_armazenada = $admin['senha'];
                    echo "Senha no banco de dados: $senha_armazenada<br>";
                    echo "Senha digitada: $senha_digitada<br>";
                    
                    if ($senha_digitada === $senha_armazenada) {
                        echo "Senha correta.<br>";
                        // Credenciais válidas, inicia a sessão e redireciona para a página de admin
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_id'] = $admin['id'];
                        $_SESSION['admin_nome'] = $admin['nome'];

                        // Redireciona para a página de home interna do admin
                        header("Location: ../../view/interna/home_interna.php");
                        exit();
                    } else {
                        // Senha incorreta
                        $_SESSION['login_error'] = "Senha incorreta.";
                    }
                } else {
                    // Admin não encontrado
                    $_SESSION['login_error'] = "CPF não encontrado.";
                }
            } catch (PDOException $e) {
                // Exceção PDO (erro de banco de dados)
                $_SESSION['login_error'] = "Erro de banco de dados: " . $e->getMessage();
            } catch (Exception $e) {
                // Outras exceções
                $_SESSION['login_error'] = "Erro: " . $e->getMessage();
            }
        } else {
            // Campos não preenchidos
            $_SESSION['login_error'] = "Por favor, preencha todos os campos.";
        }
    } else {
        // Campos não foram enviados via POST
        $_SESSION['login_error'] = "Dados de login não foram recebidos.";
    }
} else {
    echo "Método não é POST.<br>";
    header("Location: ../../view/interna/adm/login_adm.php");
}

// Redireciona de volta para a página de login em caso de erro ou se não foi enviado via POST
echo "Redirecionando para a página de login.<br>";

exit();
?>
