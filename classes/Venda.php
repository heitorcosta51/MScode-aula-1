<?php

declare(strict_types=1);

class Venda
{
    private ?int $id;
    private int $clienteId;
    private string $dataVenda;
    private float $total;
    private array $itens = [];

    public function __construct(
        ?int $id,
        int $clienteId,
        string $dataVenda,
        float $total
    ) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->dataVenda = $dataVenda;
        $this->total = $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClienteId(): int
    {
        return $this->clienteId;
    }

    public function getDataVenda(): string
    {
        return $this->dataVenda;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getItens(): array
    {
        return $this->itens;
    }

    public function setTotal(float $novoTotal): void
    {
        $this->total = $novoTotal;
    }

    public function adicionarItem(
        int $produtoCodigo,
        string $produtoNome,
        int $quantidade,
        float $precoUnitario
    ): void {
        $this->itens[] = [
            'produto_codigo' => $produtoCodigo,
            'produto_nome' => $produtoNome,
            'quantidade' => $quantidade,
            'preco_unitario' => $precoUnitario,
        ];
    }

    public function calcularTotal(): float
    {
        $total = 0.0;

        foreach ($this->itens as $item) {
            $total += $item['quantidade'] * $item['preco_unitario'];
        }

        return $total;
    }

    public function limparItens(): void
    {
        $this->itens = [];
    }
}
