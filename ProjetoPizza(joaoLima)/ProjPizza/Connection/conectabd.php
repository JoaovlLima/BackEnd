<?php
// endereco
// nome do BD
// usuario
// senha
$endereco = 'localhost';
$banco = 'pd_ex4';
$adm = 'postgres';
$senha = 'postgres';

try {
    // sgbd:host;port;dbname
    // usuario
    // senha
    // errmode
    $pdo = new PDO(
        "pgsql:host=$endereco;port=5432;dbname=$banco",
        $adm,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
  
    /* $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
 */

   
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados.<br\>";
    die($e->getMessage());
}