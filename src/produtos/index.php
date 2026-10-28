<?php
require_once __DIR__ . '/../autoload.php';

use App\Database\Conexao;

$produtos = Conexao::get()
    ->query('SELECT * FROM produtos ORDER BY id DESC')
    ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        h1 { 
            color: #333;
        }

        a {
            color: #0645ad;
            margin-right: 10px;
        }

        .novo {
            display: inline-block;
            background: #333;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Lista de produtos</h1>

    <a class="novo" href="novo.php">+ Novo produto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($produtos)): ?>
                <tr>
                    <td colspan="5">Nenhum produto cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= (int) $p['id'] ?></td>

                        <td>
                            <?= htmlspecialchars($p['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            R$ <?= number_format((float) $p['preco'], 2, ',', '.') ?>
                        </td>

                        <td><?= (int) $p['estoque'] ?></td>

                        <td>
                            <a href="editar.php?id=<?= (int) $p['id'] ?>">
                                Editar
                            </a>

                            <a
                                href="excluir.php?id=<?= (int) $p['id'] ?>"
                                onclick="return confirm('Deseja excluir este produto?')"
                            >
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="../index.php">Voltar ao início</a></p>

</body>
</html>
