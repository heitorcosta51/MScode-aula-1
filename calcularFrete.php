<?php

interface CalculadorFrete {
    public function calcularFrete(float $valorProduto): float;
}