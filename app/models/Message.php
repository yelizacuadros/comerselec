<?php
require_once __DIR__ . "/../config/conexion.php";

class Message
{
        //lista los mensajes ordenados por fecha de creación, mostrando los más recientes primero
    public static function listar()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT * FROM messages ORDER BY created_at DESC";
        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    //guarda un nuevo mensaje enviado desde el formulario de contacto 
    public static function crear($name, $email, $subject, $message)
    {
        $conn = Conexion::conectar();

        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $subject = $conn->real_escape_string($subject);
        $message = $conn->real_escape_string($message);

        $sql = "INSERT INTO messages (name, email, subject, message)
                VALUES ('$name', '$email', '$subject', '$message')";

        return $conn->query($sql);
    }
}
?>