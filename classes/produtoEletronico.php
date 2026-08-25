<?php 

require_once(__DIR__ . '/produto.php');

class ProdutoEletronico extends Produto 
{
    public function apresentar(): void 
    {
        echo "Eletrônico: " . $this->nome . " - R$ " . number_format($this->getPreco(), 2, ',', '.');   
    }
}