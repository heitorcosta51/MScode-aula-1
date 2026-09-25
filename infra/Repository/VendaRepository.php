<?php

declare(strict_types=1);

require_once __DIR__ . '/../Connection.php';

class VendaRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function buscarTodas(): array
    {
        $statement = $this->connection->prepare(
            'SELECT id, cliente_id, data_venda, total
             FROM venda
             ORDER BY data_venda DESC'
        );
        $statement->execute();

        return $statement->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, cliente_id, data_venda, total
             FROM venda
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $venda = $statement->fetch();

        return $venda === false ? null : $venda;
    }

    public function buscarPorClienteId(int $clienteId): array
    {
        $statement = $this->connection->prepare(
            'SELECT id, cliente_id, data_venda, total
             FROM venda
             WHERE cliente_id = :cliente_id
             ORDER BY data_venda DESC'
        );
        $statement->execute(['cliente_id' => $clienteId]);

        return $statement->fetchAll();
    }

    public function criarVenda(int $clienteId, float $total, ?string $dataVenda = null): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO venda (cliente_id, data_venda, total)
             VALUES (:cliente_id, :data_venda, :total)'
        );
        $statement->execute([
            'cliente_id' => $clienteId,
            'data_venda' => $dataVenda ?? date('Y-m-d H:i:s'),
            'total' => $total,
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function adicionarItem(
        int $vendaId,
        int $produtoCodigo,
        int $quantidade,
        float $precoUnitario
    ): bool {
        $statement = $this->connection->prepare(
            'INSERT INTO venda_item
                (venda_id, produto_codigo, quantidade, preco_unitario)
             VALUES (:venda_id, :produto_codigo, :quantidade, :preco_unitario)'
        );

        return $statement->execute([
            'venda_id' => $vendaId,
            'produto_codigo' => $produtoCodigo,
            'quantidade' => $quantidade,
            'preco_unitario' => $precoUnitario,
        ]);
    }

    public function buscarItensDaVenda(int $vendaId): array
    {
        $statement = $this->connection->prepare(
            'SELECT vi.id,
                    vi.venda_id,
                    vi.produto_codigo,
                    p.nome AS produto_nome,
                    vi.quantidade,
                    vi.preco_unitario
             FROM venda_item vi
             INNER JOIN produtos p ON p.codigo = vi.produto_codigo
             WHERE vi.venda_id = :venda_id
             ORDER BY vi.id'
        );
        $statement->execute(['venda_id' => $vendaId]);

        return $statement->fetchAll();
    }

    public function atualizarTotal(int $vendaId, float $novoTotal): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE venda
             SET total = :total
             WHERE id = :id'
        );

        return $statement->execute([
            'id' => $vendaId,
            'total' => $novoTotal,
        ]);
    }

    public function deletar(int $vendaId): bool
    {
        $this->connection->beginTransaction();

        try {
            $itemStatement = $this->connection->prepare(
                'DELETE FROM venda_item
                 WHERE venda_id = :venda_id'
            );
            $itemStatement->execute(['venda_id' => $vendaId]);

            $vendaStatement = $this->connection->prepare(
                'DELETE FROM venda
                 WHERE id = :id'
            );
            $vendaStatement->execute(['id' => $vendaId]);

            $this->connection->commit();

            return true;
        } catch (Throwable $exception) {
            if ($this->connection->inTransaction()) {
                $this->connection->rollBack();
            }

            throw $exception;
        }
    }

    public function calcularTotalVenda(int $vendaId): ?float
    {
        $statement = $this->connection->prepare(
            'SELECT SUM(quantidade * preco_unitario) AS total
             FROM venda_item
             WHERE venda_id = :venda_id'
        );
        $statement->execute(['venda_id' => $vendaId]);
        $total = $statement->fetchColumn();

        return $total === null || $total === false ? null : (float) $total;
    }
}
