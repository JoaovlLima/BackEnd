<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';

// Verifica se o ID da pizza existe
if (isset($_GET['id'])) {
    // Verifica se o formulário foi enviado
    if (!empty($_POST)) {
        // Obtém os dados do formulário
        $id_pizza = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : '';
        $preco = isset($_POST['preco']) ? $_POST['preco'] : '';
        
        // Atualiza o registro da pizza
        $stmt = $pdo->prepare('UPDATE pizzas SET nome = ?, tamanho = ?, preco = ? WHERE id_pizza = ?');
        $stmt->execute([$nome, $tamanho, $preco, $_GET['id']]);
        
        // Define a mensagem de sucesso
        $msg = 'Pizza atualizada com sucesso!';
    }

    // Obtém os detalhes da pizza a ser atualizada
    $stmt = $pdo->prepare('SELECT * FROM pizzas WHERE id_pizza = ?');
    $stmt->execute([$_GET['id']]);
    $pizza = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a pizza foi encontrada
    if (!$pizza) {
        exit('Pizza não encontrada!');
    }
} else {
    exit('Nenhum ID de pizza especificado!');
}
?>

<?=template_header('Atualizar Pizza')?>

<div class="content update">
    <h2>Atualizar Pizza - <?= $pizza['nome'] ?></h2>
    <form action="update.php?id=<?= $pizza['id_pizza'] ?>" method="post">
        <label for="id_pizza">ID</label>
        <input type="text" name="id" value="<?= $pizza['id_pizza'] ?>" id="id" readonly>
        
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="<?= $pizza['nome'] ?>" id="nome">
        
        <label for="tamanho">Tamanho</label>
        <input type="text" name="tamanho" value="<?= $pizza['tamanho'] ?>" id="tamanho">
        
        <label for="preco">Preço</label>
        <input type="text" name="preco" value="<?= $pizza['preco'] ?>" id="preco">
        
        <input type="submit" value="Atualizar">
    </form>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
