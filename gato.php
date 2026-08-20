<?php 

require_once('animal.php');

class Gato extends Animal {
    public function fazerSom(): void
    {
        echo "Miau!";
    }
}