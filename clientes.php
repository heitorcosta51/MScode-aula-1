<?php
require_once('dados.php');

$clientes = $_SESSION['clientes'];

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Lojinha da Esquina</title>
    <!-- Fonte Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

    <!-- Cabecalho da Loja -->
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">
                Lojinha da Esquina
            </a>
            <nav class="header-nav">
                <a href="index.php" class="nav-link">Produtos</a>
                <a href="clientes.php" class="nav-link active">Clientes</a>
            </nav>
        </div>
    </header>

    <!-- Conteudo Principal -->
    <main>
        <div class="page-title">
            <h1>Lista de Clientes</h1>
            <p>Gerenciamento de clientes e saldos devedores carregados dinamicamente via PHP</p>
        </div>

        <!-- Grid de Clientes Renderizado pelo PHP -->
        <section class="clients-grid">
            <?php foreach ($clientes as $cliente): ?>
                <article class="client-card">
                    <div class="client-header">
                        <div class="client-avatar">
                            <?= strtoupper(substr($cliente->getNome(), 0, 1)) ?>
                        </div>
                        <div class="client-name-container">
                            <h2 class="client-title"><?= htmlspecialchars($cliente->getNome()) ?></h2>
                            <span class="client-id">Cliente #<?= sprintf('%03d', $cliente->id) ?></span>
                        </div>
                    </div>

                    <div class="client-details">
                        <div class="detail-row">
                            <span class="detail-label">Telefone:</span>
                            <span class="detail-value"><?= htmlspecialchars($cliente->getTelefone()) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">CPF:</span>
                            <span class="detail-value"><?= htmlspecialchars($cliente->getCpf()) ?></span>
                        </div>
                    </div>

                    <div class="client-footer">
                        <span class="debt-label">Saldo Devedor:</span>
                        <span class="debt-amount <?= $cliente->getSaldoDevedor() > 0 ? 'has-debt' : 'no-debt' ?>">
                            R$ <?= number_format($cliente->getSaldoDevedor(), 2, ',', '.') ?>
                        </span>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- Rodape -->
    <footer>
        &copy; <?= date('Y') ?> Lojinha da Esquina - Sistema de Gestão com PHP e HTML
    </footer>

</body>
</html>