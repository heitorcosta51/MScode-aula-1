<?php 

require_once('./classes/produtoMovel.php');
require_once('./classes/produtoEletronico.php');

try {
  $movel = new ProdutoMovel(
        1,
        'Sofá Retrátil 3 Lugares',
        'Sofá confortável com tecido impermeável e espuma de alta densidade.',
        1899.90,
        'Móveis',
        'images/sofa.png',
        4
    );

    $eletronico = new ProdutoEletronico(
        2,
        'Smart TV 65" 4K',
        'Televisão com resolução 4K, HRD com sistema operacional inteligente',
        3200.00,
        'Eletrônicos',
        'images/tv.png',
        7,
    );

    $produtoQualquer = new Produto(
            2,
        'Smart TV 75" 4K',
        'Televisão com resolução 4K, HRD com sistema operacional inteligente',
        3200.00,
        'Eletrônicos',
        'images/tv.png',
        7,
    );

    $produtos = [$produtoQualquer, $movel, $eletronico];

    foreach ($produtos as $produto) {
        $produto->apresentar();
        echo '<br>';
    }
} catch (\Throwable $th) {
    var_dump($th);
    echo $th->getMessage();
}