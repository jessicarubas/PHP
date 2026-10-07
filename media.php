<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];

    $media = ($nota1 + $nota2) / 2;

    if ($media >= 7) {
        $situacao = "Aprovado";
    } elseif ($media >= 5) {
        $situacao = "Recuperação";
    } else {
        $situacao = "Reprovado";
    }

    echo "Média: " . $media . "<br>";
    echo "Situação: " . $situacao;
}
?>

<form method="POST">
    <label>Nota 1:</label>
    <input type="number" name="nota1" step="0.1">

    <br><br>

    <label>Nota 2:</label>
    <input type="number" name="nota2" step="0.1">

    <br><br>

    <button type="submit">Calcular média</button>
</form>