<?php

require_once(__DIR__ . '/../calcularFrete.php');

class Jadlog implements CalculadorFrete {

    public function calcularFrete(float $valorProduto): float
    {
        return $valorProduto * 0.11;
    }

}