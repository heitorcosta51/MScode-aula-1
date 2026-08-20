<?php


class Pessoa {

    public function __construct(
        private readonly string $nome,
        protected string $telefone,
        protected readonly string $cpf, 
    ){

    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}