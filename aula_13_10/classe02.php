<?php
class Animal{
    const TIPO = "Animal";

    public function emitirSom(): void {}
        echo "Som qualquer";
   /* public static function identificar(); string{
        //return self::TIPO
        return static::TIPO;*/
    }

class Cachorro extends Animal{
    public function emitirSom(); void{
        parent::emitirSom();
        echo "e latido";
    }
    


}
$c = new Cachorro();
echo Cachorro::identifcar();