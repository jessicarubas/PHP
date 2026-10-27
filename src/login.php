
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email === 'admin@loja.com' && $senha === '123456') {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'nome' => 'Admin',
            'email' => $email
        ];

        header('Location: painel.php');
        exit;
    }

    $erro = 'Credenciais inválidas';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 280px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
        }

        button {
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .erro {
            color: red;
        }
    </style>
</head>
<body>

    <form method="post">
        <h2>Login</h2>

        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <input type="email" name="email" placeholder="E-mail" required>

        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit">Entrar</button>
    </form>

</body>
</html>