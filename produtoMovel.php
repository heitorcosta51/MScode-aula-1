<?php

require_once('produto.php');

class ProdutoMovel extends Produto {

    public function apresentar(): void {
        echo "Móvel: " . $this->nome . " - R$ " . number_format($this->getPreco(), 2, ',', '.') . PHP_EOL;
    }

}