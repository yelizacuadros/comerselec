<?php

class Conexion
{
    public static function conectar()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbName = getenv('DB_NAME') ?: 'comerselec';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        $port = (int) (getenv('DB_PORT') ?: 3306);

        $conn = new mysqli($host, $username, $password, $dbName, $port);

        if ($conn->connect_error) {
            error_log('DB connection failed: ' . $conn->connect_error);
            die('Error de conexión a la base de datos.');
        }

        $conn->set_charset('utf8mb4');

        return $conn;
    }
}
