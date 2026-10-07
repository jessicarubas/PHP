<?php
<form method="post">
<input name= "nome" placeholder = "seu nome">
<button> ENVIAR</button>
</form>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name";]
    echo "oLá $nome";
}
