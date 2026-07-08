<?php

class Conexion
{
    public static function conectar()
    {
        $localConfigPath = __DIR__ . '/database.local.php';

        if (file_exists($localConfigPath)) {
            $config = require $localConfigPath;
        } else {
            $config = [
                'host' => getenv('DB_HOST') ?: 'localhost',
                'db' => getenv('DB_NAME') ?: 'comerselec',
                'user' => getenv('DB_USER') ?: 'root',
                'pass' => getenv('DB_PASSWORD') ?: '',
                'port' => (int) (getenv('DB_PORT') ?: 3306),
            ];
        }

        $conn = new mysqli(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['db'],
            $config['port']
        );

        if ($conn->connect_error) {
            error_log('DB connection failed: ' . $conn->connect_error);
            die('Error de conexión a la base de datos.');
        }

        $conn->set_charset('utf8mb4');

        return $conn;
    }
}
