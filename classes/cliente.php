<?php 
require_once(__DIR__ . '/pessoa.php');

class Cliente extends Pessoa {

    public function __construct(
        public readonly int $id,
        string $nome,
         string $telefone,
        string $cpf, 
        private float $saldoDevedor,
        string $email
    ){
        parent::__construct(
            $nome, 
            $telefone,
             $cpf,
             $email
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

    public function setSaldoDevedor(float $novoSaldo): void
    {
        $this->saldoDevedor = $novoSaldo;
    }

    public function adicionarSaldo(float $valor): void
    {
        $this->saldoDevedor += $valor;
    }
}