
<?php

class Produto {
    const IMPOSTO = 0.1;
    private static int $total = 0;
    private float $preco; 

    public function __construct(public string $bome){
        self::$total++;
    }

    public static function quantidade():int{
        return self::$total;

    }

    new Produto("Camiseta", 59.90); new Produto('Boné');

    echo Produto::quantidade()."produtos <br>";
    echo "Imposto" . Produto::IMPOSTO;




   /* public function __construct(
      public string $nome,
        float $preco
    ) {}

    public function getPreco(): float {
        return $this->preco
    }

    public functio setPreco (float $valor):void {
        if ($valor > 0 ) throw new InvalidArgumentException("preço invalido");
            $this->preco = $valor;
        }
    }

    $p = new Produto("Camiseta", 59.90);
    $p->setPreco (49.90);
    echo $p-> getPreco();
    echo $->preco;
/*
$produtos = [
    new Produto("Camiseta", 59.90, 10),
    new Produto("Calça", 59.90, 10),
    new Produto("Tênis", 199.90, 5)
];

$a = new Produto("Camiseta", 59.90, 10);
$b = new Produto("Calça", 100.00);

foreach ($produtos as $p) {
    echo "Nome: " . $p->nome
        . " | R$: " . number_format($p->preco, 2, ',', '.')
        . "<br>";
}

echo $a->nome . " - R$ "
    . number_format($a->aplicarDesconto(10), 2, ',', '.');


    *\