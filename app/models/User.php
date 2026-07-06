<?php
require_once __DIR__ . "/../config/conexion.php"; 

class User
{
    //valida credenciales del usuario para iniciar sesión  
    public static function login($username, $password)
    {
        $conn = Conexion::conectar();

        $username = $conn->real_escape_string($username);

        $sql = "SELECT id, username, password, role 
                FROM users 
                WHERE username='$username' 
                LIMIT 1";

        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                return $user; // devuelve usuario completo
            }
        }

        return false;
    }
    //registra un nuevo usuario en la base de datos, validando si ya existe

    public static function registrar($username, $password, $role)
    {
        $conn = Conexion::conectar();

        $username = $conn->real_escape_string($username);
        $role = $conn->real_escape_string($role);
        $password = password_hash($password, PASSWORD_BCRYPT);

        // validar si existe
        $check = "SELECT id FROM users WHERE username='$username' LIMIT 1";
        $res = $conn->query($check);

        if ($res->num_rows > 0) {
            return "Usuario ya existe";
        }

        $sql = "INSERT INTO users (username, password, role)
                VALUES ('$username', '$password', '$role')";

        if ($conn->query($sql)) {
            return "ok";
        }

        return "Error al registrar";
    }
    //obtiene un usuario por su id 
    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT id, username, role FROM users WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }
    //lista todos los usuarios registrados en la base de datos
    public static function listar()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT id, username, role FROM users ORDER BY id DESC";
        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    //elimina un usuario existente por su id
    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "DELETE FROM users WHERE id=$id";

        return $conn->query($sql);
    }
}
?>