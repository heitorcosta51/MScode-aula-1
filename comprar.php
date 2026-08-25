<?php
require_once('dados.php');
require_once('./classes/compraService.php');

try {
    $produtoId = $_GET['id'] ?? null;

    $cliente = $_SESSION['clientes'][1];

    $_SESSION['cliente'] = $cliente;
    $produto = $_SESSION['produtos'][$produtoId];

    $_SESSION['clientes'][1] = $cliente->registrarCompra($produto, 1);
    $_SESSION['produtos'][$produtoId] = $produto;

    $whatsapp = new Whastapp();
    $compraService = new CompraService($whatsapp);
    $compraService->finalizarCompra($cliente->getTelefone());

    header('Location: clientes.php');

} catch (\Throwable $error) {
    echo $error->getMessage();
}
