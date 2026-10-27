
<?php

require __DIR__ . '/autoload.php';

use App\Support\CarrinhoSessao;

$c = new CarrinhoSessao();

if (isset($_GET['id'])) {
    $c->adicionar((int) $_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        h1 {
            color: #333;
        }

        .produto {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Meu Carrinho</h1>

    <?php foreach ($c->itens() as $id => $qtd): ?>
        <div class="produto">
            Produto #<?= $id ?> - Quantidade: <?= $qtd ?>
        </div>
    <?php endforeach; ?>

</body>
</html>