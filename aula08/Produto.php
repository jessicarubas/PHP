
<?php

abstract class Produto {
    public function __construct(
        protected string $nome,
        protected float $preco
    ) {}

    abstract public function frete(): float;

    public function descricao(): string {
        return "{$this->nome}: R$ " . number_format(
            $this->preco, 2, ',', '.'
        );
    }

    public function total(): float {
        return $this->preco + $this->frete();
    }
}

class ProdutoFisico extends Produto {
    public function __construct(
        string $nome,
        float $preco,
        protected float $pesoKg
    ) {
        parent::__construct($nome, $preco);
    }

    public function frete(): float {
        return $this->pesoKg * 5;
    }
}

class ProdutoDigital extends Produto {
    public function __construct(
        string $nome,
        float $preco,
        private string $link
    ) {
        parent::__construct($nome, $preco);
    }

    public function frete(): float {
        return 0.0;
    }
}
