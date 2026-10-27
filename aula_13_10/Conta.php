
<?php

class Conta {
    private float $saldo;

    public function __construct(float $saldo = 0) {
        if ($saldo < 0) {
            throw new InvalidArgumentException(
                "O saldo não pode ser negativo!"
            );
        }

        $this->saldo = $saldo;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }

    public function depositar(float $valor): bool {
        if ($valor <= 0) {
            return false;
        }

        $this->saldo += $valor;
        return true;
    }

    public function sacar(float $valor): bool {
        if ($valor <= 0 || $valor > $this->saldo) {
            return false;
        }

        $this->saldo -= $valor;
        return true;
    }
}
