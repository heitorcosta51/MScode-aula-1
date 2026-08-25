<?php
require_once('dados.php');
require_once('./classes/compraService.php');
require_once('./classes/whatsapp.php');
require_once('./classes/correios.php');
 
try {
    $produtoId = $_GET['id'] ?? null;
 
    $cliente = $_SESSION['clientes'][1];
 
    $_SESSION['cliente'] = $cliente;
    $produto = $_SESSION['produtos'][$produtoId];
 
    $_SESSION['clientes'][1] = $cliente->registrarCompra($produto, 1);
    $_SESSION['produtos'][$produtoId] = $produto;
 
    $whatsapp = new Whatsapp();
 
    $calculadorFrete = new Correios();
 
    $compraService = new CompraService($whatsapp, $calculadorFrete);

    $compraService->finalizarCompra(
        $cliente->getTelefone(),
        $cliente->getNome(),
        $produto->getPreco()
    );
 
    header('Location: clientes.php');
 
} catch (\Throwable $error) {
    echo $error->getMessage();
}