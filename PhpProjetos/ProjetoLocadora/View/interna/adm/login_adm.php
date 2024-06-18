<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Estilo CSS, ajuste conforme necessário -->
</head>
<body>

<div class="container">
    <h1>Login Administrador</h1>
    
    <form action="../../../Connection/processa_login_adm.php" method="post">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
