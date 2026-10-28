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

$pdo->prepare('DELETE FROM produtos WHERE id = :id')
    ->execute([':id' => $id]);

header('Location: index.php');
exit;
