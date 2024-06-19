<?php
include_once('../Connection/conectaBD.php');

session_start();

// Verifica se o funcionário está logado
if (!isset($_SESSION['funcionario'])) {
    header("Location: Login.php");
    exit();
}

?>

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
  
<?php include './fragmentos/hearder.php' ?>
  <?=template_header('Header')?>
  
    <div class="carousel" style="background-color: #8BC34A;">
      <!-- Aqui você pode adicionar as imagens do seu carrossel posteriormente -->
    </div>
 <div class="titulo-cards">
  <h1>Conheça nossa Frota</h1>
  <h3>Os melhores preços você encontra aqui!!</h3>
 </div>

    <div class="carousel-de-cards">
      <div class="carousel2">
      <?php
      // Verifica se o carrinho não está vazio

      $sql = "SELECT modelo, tipo, ano, img FROM Carros";
          $stmt = $pdo->query($sql);

          // Verifica se há carros no resultado
          if ($stmt->rowCount() > 0) {
              // Loop para exibir os carros no carrossel
              while ($carro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $modelo = htmlspecialchars($carro['modelo']);
                  $tipo = htmlspecialchars($carro['tipo']);
                  $ano = intval($carro['ano']);
                  $img = htmlspecialchars($carro['img']); 

                  // Exibir o card com os detalhes do carro
                  echo "<div class='carousel-card'>";
                  echo "<img src='/images/$img' alt='$modelo'>";
                  echo "<p>Modelo: $modelo</p>";
                  echo "<p>Tipo: $tipo</p>";
                  echo "<p>Ano: $ano</p>";
                  echo "</div>";
              }
          } else {
              echo "<p>Nenhum carro encontrado.</p>";
          }
      ?>
      </div>
      <div class="carousel-controls">
        <button id="prevBtn">❮</button>
        <button id="nextBtn">❯</button>
      </div>
    </div>

    <div class="botao">
      <a href="carros.php">
    <button class="custom-button">Confira todos os carros</button>
    </a>
  </div>
  <main>
 
    <!-- Seções de destaque, pesquisa rápida, destaques de carros, etc. -->
  </main>
  <footer>
    <div class="footer-content">
      <ul>
        <li><a href="#">Termos de Serviço</a></li>
        <li><a href="#">Política de Privacidade</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <div class="social-icons">
        <a href="#"><img src="facebook.png" alt="Facebook"></a>
        <a href="#"><img src="twitter.png" alt="Twitter"></a>
        <a href="#"><img src="instagram.png" alt="Instagram"></a>
      </div>
    </div>
  </footer>

  <script>
  
  </script>
</body>
<script src="/View/js/index.js"></script>
</html>
