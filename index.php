<?php
require_once('dados.php');


$produtos = $_SESSION['produtos'];

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lojinha da esquina</title>
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
                <a href="index.php" class="nav-link active">Produtos</a>
                <a href="clientes.php" class="nav-link">Clientes</a>
            </nav>
            <div class="cart-icon">
                 Carrinho (0)
            </div>
        </div>
    </header>

    <!-- Conteudo Principal -->
    <main>
        <div class="page-title">
            <h1>Produtos em Destaque</h1>
            <p>Confira nossas ofertas exclusivas carregadas dinamicamente via PHP</p>
        </div>

        <!-- Grid de Produtos Renderizado pelo PHP -->
        <section class="products-grid">
            <?php foreach ($produtos as $produto): ?>
                <article class="product-card">
                    <div class="image-container">
                        <img src="<?= htmlspecialchars($produto->getCaminhoImagem()) ?>" alt="<?= htmlspecialchars($produto->nome) ?>">
                    </div>
                    <div class="product-info">
                        <div class="product-meta">
                            <!-- Categoria vinda do Array em PHP -->
                            <span class="category-badge">
                                <?= htmlspecialchars($produto->getCategoria()) ?>
                            </span>

                            <!-- Quantidade em Estoque vinda do Array em PHP -->
                            <span class="stock-badge <?= $produto->getQuantidade() <= 5 ? 'low-stock' : '' ?>">
                                Estoque: <?= (int)$produto->getQuantidade ()?> un.
                            </span>
                        </div>

                        <!-- Nome vindo do Array em PHP -->
                        <h2 class="product-title">
                            <?= htmlspecialchars($produto->nome) ?>
                        </h2>

                        <!-- Descricao vinda do Array em PHP -->
                        <p class="product-description">
                            <?= htmlspecialchars($produto->descricao) ?>
                        </p>

                        <div class="product-footer">
                            <!-- Preco vindo do Array em PHP com formatação R$ -->
                            <span class="product-price">
                                R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?>
                            </span>
                            <a href="comprar.php?id=<?= $produto->codigo ?>" class="btn-buy">Comprar</a>                        
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- Rodape -->
    <footer>
        &copy; <?= date('Y') ?> Lojinha da Esquina - Exemplo de E-commerce com PHP e HTML
    </footer>

</body>
</html>