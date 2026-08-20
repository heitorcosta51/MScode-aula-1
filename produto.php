<?php 
 
class Produto {
 
    public function __construct(
        public readonly int $codigo,
        public readonly string $nome,
        public readonly string $descricao,
        private float $preco,
        private string $categoria,
        private string $caminhoImagem,
        private int $quantidade
    )
    {
        if($this->preco < 0) {
            throw new Exception("Preço não pode ser negativo");
        }
    }
    
    public function getPreco(): float 
    {
        return $this->preco;
    }
 
    public  function getCategoria(): string 
    {
        return $this->categoria;
    }
 
    public function getCaminhoImagem(): string
     {
        return $this->caminhoImagem;
    }
 
    public function getQuantidade(): int 
    {
        return $this->quantidade;
    }
 
    public function vender(int $quantidade)
    {
        if ($this->quantidade >= $quantidade) {
            $this->quantidade -= $quantidade;
 
        } else {
            throw new Exception("Quantidade Insuficiente pra compra", 500);
            
        }
    }
 
    public function apresentar(): void
    {
        echo $this->nome . PHP_EOL;
    }
 
}