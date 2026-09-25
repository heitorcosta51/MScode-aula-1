<?php

declare(strict_types=1);

require_once __DIR__ . '/../Connection.php';
require_once __DIR__ . '/../../classes/cliente.php';

class ClienteRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /** @return Cliente[] */
    public function buscarTodos(): array
    {
        $statement = $this->connection->prepare(
            'SELECT id, nome, telefone, cpf, saldo_devedor, email
             FROM clientes
             ORDER BY id'
        );
        $statement->execute();

        $clientes = [];

        foreach ($statement->fetchAll() as $row) {
            $clientes[] = $this->mapearParaCliente($row);
        }

        return $clientes;
    }

    public function buscarPorId(int $id): ?Cliente
    {
        $statement = $this->connection->prepare(
            'SELECT id, nome, telefone, cpf, saldo_devedor, email
             FROM clientes
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        return $row === false ? null : $this->mapearParaCliente($row);
    }

    public function buscarPorCpf(string $cpf): ?Cliente
    {
        $statement = $this->connection->prepare(
            'SELECT id, nome, telefone, cpf, saldo_devedor, email
             FROM clientes
             WHERE cpf = :cpf'
        );
        $statement->execute(['cpf' => $cpf]);
        $row = $statement->fetch();

        return $row === false ? null : $this->mapearParaCliente($row);
    }

    public function inserir(Cliente $cliente): Cliente
    {
        $statement = $this->connection->prepare(
            'INSERT INTO clientes (nome, telefone, cpf, saldo_devedor, email)
             VALUES (:nome, :telefone, :cpf, :saldo_devedor, :email)'
        );
        $statement->execute([
            'nome' => $cliente->getNome(),
            'telefone' => $cliente->getTelefone(),
            'cpf' => $cliente->getCpf(),
            'saldo_devedor' => $cliente->getSaldoDevedor(),
            'email' => $this->obterEmail($cliente),
        ]);

        return new Cliente(
            (int) $this->connection->lastInsertId(),
            $cliente->getNome(),
            $cliente->getTelefone(),
            $cliente->getCpf(),
            $cliente->getSaldoDevedor(),
            $this->obterEmail($cliente)
        );
    }

    public function atualizar(Cliente $cliente): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE clientes
             SET nome = :nome,
                 telefone = :telefone,
                 cpf = :cpf,
                 saldo_devedor = :saldo_devedor,
                 email = :email
             WHERE id = :id'
        );

        return $statement->execute([
            'id' => $cliente->getId(),
            'nome' => $cliente->getNome(),
            'telefone' => $cliente->getTelefone(),
            'cpf' => $cliente->getCpf(),
            'saldo_devedor' => $cliente->getSaldoDevedor(),
            'email' => $this->obterEmail($cliente),
        ]);
    }

    public function atualizarSaldo(int $clienteId, float $novoSaldo): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE clientes
             SET saldo_devedor = :saldo_devedor
             WHERE id = :id'
        );

        return $statement->execute([
            'id' => $clienteId,
            'saldo_devedor' => $novoSaldo,
        ]);
    }

    public function deletar(int $id): bool
    {
        $statement = $this->connection->prepare(
            'DELETE FROM clientes
             WHERE id = :id'
        );

        return $statement->execute(['id' => $id]);
    }

    private function mapearParaCliente(array $row): Cliente
    {
        return new Cliente(
            (int) $row['id'],
            (string) $row['nome'],
            (string) $row['telefone'],
            (string) $row['cpf'],
            (float) $row['saldo_devedor'],
            (string) $row['email']
        );
    }

    private function obterEmail(Cliente $cliente): string
    {
        $property = new ReflectionProperty(Pessoa::class, 'email');

        return (string) $property->getValue($cliente);
    }
}
