<?php

class Cliente {
    public int $id;
    public string $nome;
    public string $telefone;
    public string $cpf;
    public float $saldo_devedor;

    public function apresentar(): string
    {
        return "Cliente: " . $this->nome;
    }
}
