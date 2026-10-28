<?php
require_once __DIR__ . '/../autoload.php';

use App\Database\Conexao;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $preco = (float) ($_POST['preco'] ?? 0);
    $estoque = (int) ($_POST['estoque'] ?? 0);

    if ($nome !== '' && $preco >= 0 && $estoque >= 0) {
        $stmt = Conexao::get()->prepare(
            'INSERT INTO produtos (nome, preco, estoque)
             VALUES (:n, :p, :e)'
        );

        $stmt->execute([
            ':n' => $nome,
            ':p' => $preco,
            ':e' => $estoque
        ]);

        header('Location: index.php');
        exit;
    }

    $erro = 'Preencha os dados corretamente.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo produto</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        form {
            background: white;
            padding: 20px;
            max-width: 350px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <h1>Cadastrar produto</h1>

    <?php if (isset($erro)): ?>
        <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="preco">Preço (R$):</label>
        <input type="number" id="preco" name="preco"
               min="0" step="0.01" required>

        <label for="estoque">Estoque:</label>
        <input type="number" id="estoque" name="estoque"
               min="0" step="1" required>

        <button type="submit">Salvar produto</button>
    </form>

    <p><a href="index.php">Voltar aos produtos</a></p>

</body>
</html>
