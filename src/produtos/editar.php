<?php
require_once __DIR__ . '/../autoload.php';

use App\Database\Conexao;
use App\Support\ImagemProduto;

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
    try {
        $imagem = ImagemProduto::salvar($_FILES['imagem'] ?? null, $p['imagem'] ?? null);
        $pdo->prepare(
            'UPDATE produtos SET nome = :n, preco = :p, estoque = :e, imagem = :i WHERE id = :id'
        )->execute([
            ':n' => trim($_POST['nome'] ?? ''),
            ':p' => $_POST['preco'] ?? 0,
            ':e' => $_POST['estoque'] ?? 0,
            ':i' => $imagem,
            ':id' => $id
        ]);

        header('Location: index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $erro = $e->getMessage();
    }
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

    <?php if (isset($erro)): ?>
        <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
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

        <?php if (!empty($p['imagem'])): ?>
            <p>Imagem atual:</p>
            <img
                src="../<?= htmlspecialchars($p['imagem'], ENT_QUOTES, 'UTF-8') ?>"
                alt="Imagem de <?= htmlspecialchars($p['nome'], ENT_QUOTES, 'UTF-8') ?>"
                style="max-width: 150px; max-height: 120px; object-fit: contain"
            >
            <br><br>
        <?php endif; ?>

        <label for="imagem">Trocar imagem (opcional):</label>
        <input
            type="file"
            id="imagem"
            name="imagem"
            accept="image/jpeg,image/png,image/webp"
        >

        <br><br>

        <button type="submit">Salvar alterações</button>
        <a href="index.php">Cancelar</a>
    </form>

</body>
</html>
