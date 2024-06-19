<?php
include 'conectaBD.php';

if (isset($_GET['re'])) {
    $re = $_GET['re'];

    $sql = "DELETE FROM funcionario WHERE re = :re";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':re' => $re]);

    echo "Funcionário deletado com sucesso!";
    header('Location: read.php');
}
?>
