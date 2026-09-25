<?php

declare(strict_types=1);

class Connection
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $env = self::loadEnv();
        $requiredVariables = ['DB_HOST', 'DB_PORT', 'DB_USER', 'DB_PASSWORD', 'DB_NAME'];

        foreach ($requiredVariables as $variable) {
            if (!array_key_exists($variable, $env)) {
                throw new RuntimeException("A variável {$variable} não foi encontrada no arquivo .env.");
            }
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $env['DB_HOST'],
            $env['DB_PORT'],
            $env['DB_NAME']
        );

        try {
            self::$connection = new PDO(
                $dsn,
                $env['DB_USER'],
                $env['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $exception) {
            throw new RuntimeException(
                'Não foi possível conectar ao banco de dados MySQL: ' . $exception->getMessage(),
                (int) $exception->getCode(),
                $exception
            );
        }

        return self::$connection;
    }

    public static function loadEnv(): array
    {
        $envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';

        if (!is_file($envPath) || !is_readable($envPath)) {
            throw new RuntimeException("O arquivo .env não existe ou não pode ser lido: {$envPath}");
        }

        $variables = [];
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            throw new RuntimeException("Não foi possível ler o arquivo .env: {$envPath}");
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $separatorPosition = strpos($line, '=');

            if ($separatorPosition === false) {
                continue;
            }

            $name = trim(substr($line, 0, $separatorPosition));
            $value = trim(substr($line, $separatorPosition + 1));

            if ($name === '') {
                continue;
            }

            if (
                strlen($value) >= 2
                && (($value[0] === '"' && $value[strlen($value) - 1] === '"')
                    || ($value[0] === "'" && $value[strlen($value) - 1] === "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            $variables[$name] = $value;
            $_ENV[$name] = $value;
            putenv("{$name}={$value}");
        }

        return $variables;
    }

    public static function closeConnection(): void
    {
        self::$connection = null;
    }
}
