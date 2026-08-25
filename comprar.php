<?php
require_once(__DIR__ . '/dados.php');
require_once(__DIR__ . '/../classes/compraService.php');
require_once(__DIR__ . '/../classes/whatsapp.php');
require_once(__DIR__ . '/../classes/correios.php');
require_once(__DIR__ . '/../classes/jadlog.php');
 
try {
    $produtoId = $_GET['id'] ?? null;
 
    if (!isset($produtoId, $_SESSION['produtos'][$produtoId])) {
        throw new InvalidArgumentException('Produto inválido.');
    }

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