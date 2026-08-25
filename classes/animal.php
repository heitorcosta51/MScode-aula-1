<?php 
abstract class Animal {

     public function __construct(protected string $nome)
    {
    }


    public function apresentar(): void
    {
        echo "Eu sou o(a) $this->nome". PHP_EOL;
    }

  public function fazerSomGato(): void
    {
        echo "Miau";
    }

      public function fazerSomCachorro(): void
    {
        echo "Au au";
    }
    
    abstract public function fazerSom(): void;
}