<?php
require_once __DIR__ . '/../autoload.php';

use App\Database\Conexao;

$pdo = Conexao::get();

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = :id');
$stmt->execute([':id' => $id]);

$p = $stmt->fetch();

if (!$p) {
    http_response_code(404);
    exit('Não encontrado');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare(
        'UPDATE produtos SET nome = :n, preco = :p, estoque = :e WHERE id = :id'
    )->execute([
        ':n' => $_POST['nome'],
        ':p' => $_POST['preco'],
        ':e' => $_POST['estoque'],
        ':id' => $id
    ]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto</title>
</head>
<body>

    <h1>Editar produto</h1>

    <form method="post">
        <label>Nome:</label>
        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($p['nome']) ?>"
            required
        >

        <br><br>

        <label>Preço:</label>
        <input
            type="number"
            name="preco"
            step="0.01"
            value="<?= htmlspecialchars((string)$p['preco']) ?>"
            required
        >

        <br><br>

        <label>Estoque:</label>
        <input
            type="number"
            name="estoque"
            value="<?= htmlspecialchars((string)$p['estoque']) ?>"
            required
        >

        <br><br>

        <button type="submit">Salvar alterações</button>
        <a href="index.php">Cancelar</a>
    </form>

</body>
</html>
