<?php
class Conexion{

    public static function conectar(){

        $host = "localhost";
        $db_name = "comerselec";
        $username = "root";
        $password = "";
        $puerto = 3306;

        $conn = new mysqli($host, $username, $password, $db_name, $puerto);

        if($conn->connect_error){
            die("Error de conexión: " . $conn->connect_error);
        }

        return $conn;
    }
}

