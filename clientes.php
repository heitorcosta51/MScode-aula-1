<?php

require_once('cliente.php');

$arrayClientes = [
    [
        'id'            => 1,
        'nome'          => 'Carlos Eduardo Silva',
        'telefone'      => '(11) 98765-4321',
        'cpf'           => '123.456.789-00',
        'saldo_devedor' => 450.50
    ],
    [
        'id'            => 2,
        'nome'          => 'Mariana Oliveira Souza',
        'telefone'      => '(21) 99876-5432',
        'cpf'           => '987.654.321-11',
        'saldo_devedor' => 0.00
    ],
    [
        'id'            => 3,
        'nome'          => 'Roberto Santos Costa',
        'telefone'      => '(31) 97654-3210',
        'cpf'           => '456.789.123-22',
        'saldo_devedor' => 1250.00
    ],
    [
        'id'            => 4,
        'nome'          => 'Fernanda Lima Rocha',
        'telefone'      => '(41) 98123-4567',
        'cpf'           => '321.654.987-33',
        'saldo_devedor' => 89.90
    ]
];

$clientes = [];
foreach ($arrayClientes as $arrayCliente) {

    $cliente = new Cliente();

    $cliente->id            = $arrayCliente['id'];
    $cliente->nome          = $arrayCliente['nome'];
    $cliente->telefone      = $arrayCliente['telefone'];
    $cliente->cpf           = $arrayCliente['cpf'];
    $cliente->saldo_devedor = $arrayCliente['saldo_devedor'];

    $clientes[] = $cliente;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Lojinha da Esquina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

    <header>
        <div class="header-container">
            <a href="index.php" class="logo">Lojinha da Esquina</a>
            <nav class="header-nav">
                <a href="index.php" class="nav-link">Produtos</a>
                <a href="clientes.php" class="nav-link active">Clientes</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-title">
            <h1>Lista de Clientes</h1>
            <p>Gerenciamento de clientes e saldos devedores carregados dinamicamente via PHP</p>
        </div>

        <section class="clients-grid">
            <?php foreach ($clientes as $cliente): ?>
                <article class="client-card">
                    <div class="client-header">
                        <div class="client-avatar">
                            <?= strtoupper(substr($cliente->nome, 0, 1)) ?>
                        </div>
                        <div class="client-name-container">
                            <h2 class="client-title"><?= htmlspecialchars($cliente->nome) ?></h2>
                            <span class="client-id">Cliente #<?= sprintf('%03d', $cliente->id) ?></span> 
                        </div>
                    </div>

                    <div class="client-details">
                        <div class="detail-row">
                            <span class="detail-label">Telefone:</span>
                            <span class="detail-value"><?= htmlspecialchars($cliente->telefone) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">CPF:</span>
                            <span class="detail-value"><?= htmlspecialchars($cliente->cpf) ?></span>
                        </div>
                    </div>

                    <div class="client-footer">
                        <span class="debt-label">Saldo Devedor:</span>
                        <span class="debt-amount <?= $cliente->saldo_devedor > 0 ? 'has-debt' : 'no-debt' ?>">
                            R$ <?= number_format($cliente->saldo_devedor, 2, ',', '.') ?>
                        </span>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        &copy; <?= date('Y') ?> Lojinha da Esquina - Sistema de Gestão com PHP e HTML
    </footer>

</body>
</html>