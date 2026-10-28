<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            text-align: center;
            padding-top: 100px;
        }

        .painel {
            background: white;
            padding: 30px;
            margin: auto;
            width: 300px;
            border-radius: 8px;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            color: white;
            background: #333;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>
<body>

    <div class="painel">
        <h2>
            Olá, <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário', ENT_QUOTES, 'UTF-8') ?>!
        </h2>

        <a href="sair.php">Sair</a>
    </div>

</body>
</html>
