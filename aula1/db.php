<?php

try{
    $pdo = new PDO(
        "mysql:host=db;dbname=loja;charset=utf8mb4",
        "root", "root"
    );
    echo "conectou";

}catch(PDOExpeption $e){
    echo "erro: ". $e->getMessage();
}