<?php 

require_once(__DIR__ . '/animal.php');


class Cachorro extends Animal {
    
    public function fazerSom(): void
    {
        echo "Au au!";
    }
}