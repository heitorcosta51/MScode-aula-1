<?php 

require_once(__DIR__ . '/../classes/cliente.php');
require_once(__DIR__ . '/../classes/produto.php');
require_once(__DIR__ . '/../classes/animal.php');
require_once(__DIR__ . '/../classes/gato.php');
require_once(__DIR__ . '/../classes/cachorro.php');

session_start();


$arrayClientes = [
    [
        'id'            => 1,
        'nome'          => 'Carlos Eduardo Silva',
        'telefone'      => '(11) 98765-4321',
        'cpf'           => '123.456.789-00',
        'saldo_devedor' => 450.50,
        'email'=> 'davirocha2002.dr@gmail.com'
    ],
    [
        'id'            => 2,
        'nome'          => 'Mariana Oliveira Souza',
        'telefone'      => '(21) 99876-5432',
        'cpf'           => '987.654.321-11',
        'saldo_devedor' => 0.00,
        'email'=> 'teste@teste.com'
    ],
    [
        'id'            => 3,
        'nome'          => 'Roberto Santos Costa',
        'telefone'      => '(31) 97654-3210',
        'cpf'           => '456.789.123-22',
        'saldo_devedor' => 1250.00,
        'email'=> 'teste@teste.com'
    ],
    [
        'id'            => 4,
        'nome'          => 'Fernanda Lima Rocha',
        'telefone'      => '(41) 98123-4567',
        'cpf'           => '321.654.987-33',
        'saldo_devedor' => 89.90,
        'email'=> 'teste@teste.com'
    ]
];

foreach ($arrayClientes as $arrayCliente) {
    $cliente = new Cliente(
        $arrayCliente['id'],
        $arrayCliente['nome'],
        $arrayCliente['telefone'],
        $arrayCliente['cpf'],
        $arrayCliente['saldo_devedor'],
        $arrayCliente['email']
    );

    $clientes[] = $cliente;

    if (!isset($_SESSION['clientes'][$cliente->id])) {
        $_SESSION['clientes'][$cliente->getId()] = $cliente;
    }
}


$arrayProdutos = [
    [
        'id'        => 1,
        'nome'      => 'Fone de Ouvido Bluetooth Pro',
        'descricao' => 'Som de alta fidelidade com cancelamento ativo de ruído (ANC) e bateria com até 30h de duração.',
        'preco'     => 299.90,
        'categoria' => 'Eletrônicos',
        'imagem'    => 'images/fone.png',
        'estoque'   => 15
    ],
    [
        'id'        => 2,
        'nome'      => 'Smartwatch Sport Fit',
        'descricao' => 'Monitoramento cardíaco 24/7, GPS integrado, tela AMOLED HD e resistência à água (5 ATM).',
        'preco'     => 450.00,
        'categoria' => 'Acessórios',
        'imagem'    => 'images/smartwatch.png',
        'estoque'   => 8
    ],
    [
        'id'        => 3,
        'nome'      => 'Teclado Mecânico RGB',
        'descricao' => 'Switches mecânicos táteis, iluminação RGB personalizável e estrutura durável em alumínio.',
        'preco'     => 389.99,
        'categoria' => 'Periféricos',
        'imagem'    => 'images/teclado.png',
        'estoque'   => 3
    ],
    [
        'id'        => 4,
        'nome'      => 'Mochila Impermeável Tech',
        'descricao' => 'Compartimento acolchoado para notebook de 15.6", saída USB externa e tecido resistente à água.',
        'preco'     => 189.90,
        'categoria' => 'Acessórios',
        'imagem'    => 'images/mochila.png',
        'estoque'   => 9
    ]
];

$produtos = [];
foreach ($arrayProdutos as $arrayProduto) {
    $produto = new Produto(
        $arrayProduto['id'],
        $arrayProduto['nome'],
        $arrayProduto['descricao'],
        $arrayProduto['preco'],
        $arrayProduto['categoria'],
        $arrayProduto['imagem'],
        $arrayProduto['estoque']
    );

        if (!isset($_SESSION['produtos'][$produto->codigo])) {
        $_SESSION['produtos'][$produto->codigo] = $produto;
        } else {
                $produto = $_SESSION['produtos'][$produto->codigo];
    }

    $produtos[] = $produto;
}

$pessoa = new Pessoa(
    'Davi',
    '2799999999',
    '12345678910',
    'teste@email.com'
);