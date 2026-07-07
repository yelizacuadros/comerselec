<?php
require_once __DIR__ . "/../config/conexion.php";

class User
{
    // Valida credenciales para iniciar sesión
    public static function login($username, $password){
        $conn = Conexion::conectar();

        $username = $conn->real_escape_string($username);

        $sql = "SELECT id, username, password
                FROM users
                WHERE username='$username'
                LIMIT 1";

        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    // Registra un nuevo usuario
    public static function registrar($username, $password){
        $conn = Conexion::conectar();

        $username = $conn->real_escape_string($username);
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Validar si el usuario ya existe
        $check = "SELECT id FROM users WHERE username='$username' LIMIT 1";
        $res = $conn->query($check);

        if ($res->num_rows > 0) {
            return "Usuario ya existe";
        }

        $sql = "INSERT INTO users (username, password)
                VALUES ('$username', '$password')";

        if ($conn->query($sql)) {
            return "ok";
        }

        return "Error al registrar";
    }

    // Lista todos los usuarios
    public static function listar(){
        $conn = Conexion::conectar();

        $sql = "SELECT id, username, password, created_at
                FROM users
                ORDER BY username ASC";

        $res = $conn->query($sql);

        $usuarios = [];

        while ($row = $res->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    // Obtiene un usuario por ID
    public static function obtenerPorId($id){
        $conn = Conexion::conectar();

        $id = (int)$id;

        $sql = "SELECT id, username, password, created_at
                FROM users
                WHERE id=$id
                LIMIT 1";

        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }

    // Crea un usuario desde el panel de administración
    public static function crear($username, $password, $created_at){
        $conn = Conexion::conectar();

        $username = $conn->real_escape_string($username);
        $created_at = $conn->real_escape_string($created_at);

        // Validar si el usuario ya existe
        $check = "SELECT id FROM users WHERE username='$username' LIMIT 1";
        $res = $conn->query($check);

        if ($res->num_rows > 0) {
            return false;
        }

        // Encriptar contraseña
        $password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password, created_at)
                VALUES ('$username', '$password', '$created_at')";

        return $conn->query($sql);
    }

    // Actualiza un usuario
    public static function actualizar($id, $username, $password, $created_at){
        $conn = Conexion::conectar();

        $id = (int)$id;
        $username = $conn->real_escape_string($username);
        $created_at = $conn->real_escape_string($created_at);

        if (!empty($password)) {

            $password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE users
                    SET username='$username',
                        password='$password',
                        created_at='$created_at'
                    WHERE id=$id";

        } else {

            $sql = "UPDATE users
                    SET username='$username',
                        created_at='$created_at'
                    WHERE id=$id";
        }

        return $conn->query($sql);
    }

    // Elimina un usuario
    public static function eliminar($id){
        $conn = Conexion::conectar();

        $id = (int)$id;

        $sql = "DELETE FROM users WHERE id=$id";

        return $conn->query($sql);
    }
}
?>