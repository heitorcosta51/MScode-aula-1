<?php

require_once(__DIR__ . '/../MScode-aula-1/calcularFrete.php');

class Correios implements CalculadorFrete {

    public function calcularFrete(float $valorProduto): float
    {
        return $valorProduto * 0.10; 
    }

}