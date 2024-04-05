<?php
include 'functions.php';
// Conectar ao banco de dados PostgreSQL
$pdo = pdo_connect_pgsql();
// Obter a página via solicitação GET (parâmetro URL: page), se não existir, defina a página como 1 por padrão
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Número de registros para mostrar em cada página
$records_per_page = 5;

// Preparar a instrução SQL e obter registros da tabela de pizzas, LIMIT irá determinar a página
$stmt = $pdo->prepare('SELECT * FROM pizzas ORDER BY id_pizza OFFSET :offset LIMIT :limit');
$stmt->bindValue(':offset', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Buscar os registros para exibi-los em nosso modelo.
$pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter o número total de pizzas, isso é para determinar se deve haver um botão de próxima e anterior
$num_pizzas = $pdo->query('SELECT COUNT(*) FROM pizzas')->fetchColumn();
?>


<?=template_header('Visualizar Pizzas')?>

<div class="content read">
    <h2>Visualizar Pizzas</h2>
    <a href="createPizza.php" class="create-pizza">Cadastrar Pizza</a>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Tamanho</td>
                <td>Preço</td>
                
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pizzas as $pizza): ?>
            <tr>
                <td><?=$pizza['id_pizza']?></td>
                <td><?=$pizza['nome']?></td>
                <td><?=$pizza['tamanho']?></td>
                <td><?=$pizza['preco']?></td>
                
                <td class="actions">
                    <a href="updatePizza.php?id=<?=$pizza['id_pizza']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deletePizza.php?id=<?=$pizza['id_pizza']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page < $num_pizzas): ?>
        <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
