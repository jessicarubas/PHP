
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            text-align: center;
            padding: 30px;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px;
        }

        a {
            display: inline-block;
            background: #333;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>
<body>

    <h1>Loja PHP</h1>

    <ul>
        <li><a href="login.php">Entrar</a></li>
        <li><a href="painel.php">Painel (restrito)</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="produtos.php">Produtos</a></li>
    </ul>

</body>
</html>