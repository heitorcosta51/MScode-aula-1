<?php
 
require_once('produto.php');
require_once('produtoMovel.php');
require_once('produtoEletronico.php');
 
// Criando um objeto de cada tipo
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

$produtos = [$movel, $eletronico];

foreach ($produtos as $produto) {
    $produto->apresentar();
}