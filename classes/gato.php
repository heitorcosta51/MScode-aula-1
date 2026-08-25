<?php 

require_once(__DIR__ . '/animal.php');


class Gato extends Animal {

    public function fazerSom(): void
    {
        echo "Miau!";
    }
}