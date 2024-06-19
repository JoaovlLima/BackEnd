<?php 
function template_header($title) {
    echo <<<EOT
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>$title</title>
  <link rel="stylesheet" href="/View/css/header.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
      <nav>
        <div class="logo">
          <a href="Index.php">
            <img src="logo.png" alt="Allocate">
          </a>
          <h1>Allocate</h1>
        </div>
        <div class="header-info">
          <p><a href="/View/carros.php">Carros</a></p>
          <p><a href="/View/agencias.php">Grupo de Agências</a></p>
          <p>Ofertas</p>
        </div>
        <div class="header-links">
          <a href="../Connection/logout.php">Logout</a>
          <a href="#">Minhas Reservas</a>
          <a href="../View/interna/adm/login_adm.php">Login ADM</a>
        </div>
      </nav>
      <!-- Inputs dentro do header -->
      <div class="header-inputs">
        <form class="form-alocacao" action="./alocacao.php" method="post">
          <div class="input-group">
            <label for="cidade">Escolha sua cidade:</label>
            <input type="text" id="cidade" name="cidade" placeholder="Escolha sua cidade">
          </div>
          <div class="input-group">
            <label for="data_alocacao">Data de Alocação:</label>
            <input type="date" id="data_alocacao" name="data_alocacao" placeholder="Data de Alocação">
          </div>
          <div class="input-group">
            <label for="data_devolucao">Data de Devolução:</label>
            <input type="date" id="data_devolucao" name="data_devolucao" placeholder="Data de Devolução">
          </div>
          <div class="input-group">
            <button type="submit">Fazer Alocação</button>
          </div>
        </form>
      </div>
    </header>
EOT;
}
?>
