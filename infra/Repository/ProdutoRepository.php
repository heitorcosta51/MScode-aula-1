<?php

declare(strict_types=1);

require_once __DIR__ . '/../Connection.php';
require_once __DIR__ . '/../../classes/produto.php';

class ProdutoRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /** @return Produto[] */
    public function buscarTodos(): array
    {
        $statement = $this->connection->prepare(
            'SELECT codigo, nome, descricao, preco, categoria, caminho_imagem, quantidade
             FROM produtos
             ORDER BY codigo'
        );
        $statement->execute();

        $produtos = [];

        foreach ($statement->fetchAll() as $row) {
            $produtos[] = $this->mapearParaProduto($row);
        }

        return $produtos;
    }

    public function buscarPorCodigo(int $codigo): ?Produto
    {
        $statement = $this->connection->prepare(
            'SELECT codigo, nome, descricao, preco, categoria, caminho_imagem, quantidade
             FROM produtos
             WHERE codigo = :codigo'
        );
        $statement->execute(['codigo' => $codigo]);
        $row = $statement->fetch();

        return $row === false ? null : $this->mapearParaProduto($row);
    }

    /** @return Produto[] */
    public function buscarPorCategoria(string $categoria): array
    {
        $statement = $this->connection->prepare(
            'SELECT codigo, nome, descricao, preco, categoria, caminho_imagem, quantidade
             FROM produtos
             WHERE categoria = :categoria
             ORDER BY codigo'
        );
        $statement->execute(['categoria' => $categoria]);

        $produtos = [];

        foreach ($statement->fetchAll() as $row) {
            $produtos[] = $this->mapearParaProduto($row);
        }

        return $produtos;
    }

    public function inserir(Produto $produto): Produto
    {
        $statement = $this->connection->prepare(
            'INSERT INTO produtos
                (nome, descricao, preco, categoria, caminho_imagem, quantidade)
             VALUES (:nome, :descricao, :preco, :categoria, :caminho_imagem, :quantidade)'
        );
        $statement->execute([
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => $produto->getPreco(),
            'categoria' => $produto->getCategoria(),
            'caminho_imagem' => $produto->getCaminhoImagem(),
            'quantidade' => $produto->getQuantidade(),
        ]);

        return new Produto(
            (int) $this->connection->lastInsertId(),
            $produto->nome,
            $produto->descricao,
            $produto->getPreco(),
            $produto->getCategoria(),
            $produto->getCaminhoImagem(),
            $produto->getQuantidade()
        );
    }

    public function atualizar(Produto $produto): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE produtos
             SET nome = :nome,
                 descricao = :descricao,
                 preco = :preco,
                 categoria = :categoria,
                 caminho_imagem = :caminho_imagem,
                 quantidade = :quantidade
             WHERE codigo = :codigo'
        );

        return $statement->execute([
            'codigo' => $produto->codigo,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => $produto->getPreco(),
            'categoria' => $produto->getCategoria(),
            'caminho_imagem' => $produto->getCaminhoImagem(),
            'quantidade' => $produto->getQuantidade(),
        ]);
    }

    public function atualizarQuantidade(int $codigo, int $novaQuantidade): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE produtos
             SET quantidade = :quantidade
             WHERE codigo = :codigo'
        );

        return $statement->execute([
            'codigo' => $codigo,
            'quantidade' => $novaQuantidade,
        ]);
    }

    public function reduzirQuantidade(int $codigo, int $quantidade): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE produtos
             SET quantidade = quantidade - :quantidade
             WHERE codigo = :codigo
               AND quantidade >= :quantidade'
        );

        return $statement->execute([
            'codigo' => $codigo,
            'quantidade' => $quantidade,
        ]);
    }

    public function deletar(int $codigo): bool
    {
        $statement = $this->connection->prepare(
            'DELETE FROM produtos
             WHERE codigo = :codigo'
        );

        return $statement->execute(['codigo' => $codigo]);
    }

    private function mapearParaProduto(array $row): Produto
    {
        return new Produto(
            (int) $row['codigo'],
            (string) $row['nome'],
            (string) $row['descricao'],
            (float) $row['preco'],
            (string) $row['categoria'],
            (string) $row['caminho_imagem'],
            (int) $row['quantidade']
        );
    }
}
