<?php

declare(strict_types=1);

require_once __DIR__ . '/infra/Connection.php';
require_once __DIR__ . '/infra/Repository/ClienteRepository.php';

try {
    Connection::getConnection();

    $clienteRepository = new ClienteRepository();
    $clientes = $clienteRepository->buscarTodos();

    echo "Conexão bem-sucedida!<br>";
    echo "Total de clientes: " . count($clientes) . "<br>";

    foreach ($clientes as $cliente) {
        echo "ID: " . $cliente->getId()
            . " - Nome: " . htmlspecialchars($cliente->getNome(), ENT_QUOTES, 'UTF-8')
            . "<br>";
    }
} catch (Throwable $exception) {
    echo "Erro: " . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
}
