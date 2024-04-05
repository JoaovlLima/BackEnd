<?php 
function template_header($title) {
    echo <<<EOT

    
        <div class="left-section">
            <img src="../img/iconCasa.png" alt="Home Icon">
            <a href="/View/index.php">Home</a>
            
            <img src="../img/iconCardapio.png" alt="Menu Icon">
            <a href="#">Cardápio</a>
            <a href="/View/Funcionarios.php">funcionario</a>
            <a href="/View/Pedidos.php">Pedidos</a>
        </div>
        <img src="../img/imgFundo-.png" alt="Logo" class="logo">
        <div class="right-section">
            <a href="#">Meu Perfil</a>
            <img src="../img/imgPerfil.png" alt="Profile Icon">
        </div>

    EOT;
    }
    
    ?>