<?php 
require_once('pessoa.php');

class Cliente extends Pessoa {

    public function __construct(
        public readonly int $id,
        string $nome,
         string $telefone,
        string $cpf, 
        private float $saldoDevedor
    ){
        parent::__construct(
            $nome, 
            $telefone,
             $cpf
        );
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getSaldoDevedor(): float
    {
        return $this->saldoDevedor;
    }

    public function registrarCompra(Produto $produto, int $quantidade): self
    {
        $produto->vender($quantidade);
        $this->saldoDevedor +=  $produto->getPreco() * $quantidade;

        return $this;
    }
}