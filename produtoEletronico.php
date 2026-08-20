<?php

require_once('produto.php');

class ProdutoEletronico extends Produto {

    public function apresentar(): void
    {
        echo "Eletrônico: " . $this->nome . " - R$ " . number_format($this->getPreco(), 2, ',', '.') . PHP_EOL;
    }

}