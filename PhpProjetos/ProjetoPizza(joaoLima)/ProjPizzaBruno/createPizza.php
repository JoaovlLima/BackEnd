<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inseridas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : '';
    // Insere um novo registro na tabela de pizzas
    $stmt = $pdo->prepare('INSERT INTO pizzas (nome, tamanho, preco) VALUES (?, ?, ?)');
    $stmt->execute([$nome, $tamanho, $preco]);
    // Mensagem de saída
    $msg = 'Pizza Cadastrada com Sucesso!';
}
?>


<?=template_header('Cadastro de Pizzas')?>

<div class="content update">
    <h2>Cadastrar Pizza</h2>
    <form action="createPizza.php" method="post">
      
        <label for="nome">Nome</label>
      
        <input type="text" name="nome" placeholder="Nome da Pizza" id="nome">
        <label for="tamanho">Tamanho</label>
        <label for="preco">Preço</label>
        <input type="text" name="tamanho" placeholder="Tamanho da Pizza" id="tamanho">
        <input type="text" name="preco" placeholder="Preço da Pizza" id="preco">
        <label for="cadastro">Data do Cadastro</label>
        <input type="datetime-local" name="cadastro" value="<?=date('Y-m-d\TH:i')?>" id="cadastro">
        <input type="submit" value="Cadastrar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
