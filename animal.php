<?php 
require_once('animal.php');

abstract class Animal {

     public function __construct(
        protected string $nome

    ){
    }


    public function apresentar(): void
    {
        echo "Eu sou o(a) $this->nome". PHP_EOL;
    }

    abstract public function fazerSom();
}