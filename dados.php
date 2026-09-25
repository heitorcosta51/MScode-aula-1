<?php 

require_once(__DIR__ . '/classes/cliente.php');
require_once(__DIR__ . '/classes/produto.php');
require_once(__DIR__ . '/classes/animal.php');
require_once(__DIR__ . '/classes/gato.php');
require_once(__DIR__ . '/classes/cachorro.php');
require_once(__DIR__ . '/infra/Repository/ClienteRepository.php');
require_once(__DIR__ . '/infra/Repository/ProdutoRepository.php');
require_once(__DIR__ . '/infra/Repository/VendaRepository.php');

session_start();

// Cria os repositories responsáveis pelo acesso aos dados persistidos.
$clienteRepo = new ClienteRepository();
$produtoRepo = new ProdutoRepository();
$vendaRepo = new VendaRepository();

// Disponibiliza os registros necessários para as telas do projeto.
$clientes = $clienteRepo->buscarTodos();
$produtos = $produtoRepo->buscarTodos();

// Mantém os repositories disponíveis para uso nas próximas etapas da aplicação.
$_SESSION['clienteRepo'] = $clienteRepo;
$_SESSION['produtoRepo'] = $produtoRepo;
$_SESSION['vendaRepo'] = $vendaRepo;

$pessoa = new Pessoa(
    'Davi',
    '2799999999',
    '12345678910',
    'teste@email.com'
);