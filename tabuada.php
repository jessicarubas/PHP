<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $numero = $_POST["numero"];

    for ($i = 1; $i <= 10; $i++) {
        echo $numero . " x " . $i . " = " . ($numero * $i) . "<br>";
    }
}
?>

<form method="POST">
    <label>Digite um número:</label>
    <input type="number" name="numero">
    <button type="submit">Calcular</button>
</form>