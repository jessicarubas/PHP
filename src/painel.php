<?php

session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php'); exit;
}

echo "Olá , ". $_SESSION['usuario']['nome'];
echo " <a href="sair.php">Sair</a>";

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

        a {
            color: white;
            background: #333;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="painel">
        <h2>Olá, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h2>
        <a href="sair.php">Sair</a>
    </div>

</body>
</html>