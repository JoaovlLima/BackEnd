<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/caminho/para/seu/css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="../Connection/processa_login_funcionario.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="re">RE:</label>
            <input type="text" id="re" name="re" required><br>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
