<?php 

require_once('animal.php');

class Cachorro extends Animal {
    public function fazerSom(): void
    {
        echo "Au Au!";
    }
}