<?php 
function template_header($title) {
    global $blocos_salas; // Torna a variável global disponível dentro da função
    echo <<<EOT
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locadora de Carros Allocate</title>
  <link rel="stylesheet" href="/View/css/index.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
  <header>
    <nav>
      <div class="logo">
        <img src="logo.png" alt="Allocate">
        <h1>Allocate</h1>
      </div>
      <div class="header-info">
       <p><a href="/View/carros.php">Carros</a></p>
        <p>Grupo de Agências</p>
        <p>Ofertas</p>
      </div>
      <div class="header-links">
        <a href="#">Minhas Reservas</a>
        <a href="#">Login</a>
      </div>
    </nav>
  </header>
EOT;
}

?>