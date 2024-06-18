<?php
include 'conectaBD.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM funcionario WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "Funcionário deletado com sucesso!";
    header('Location: read.php');
}
?>
