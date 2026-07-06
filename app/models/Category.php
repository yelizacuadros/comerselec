<?php
require_once __DIR__ . "/../config/conexion.php";

class Category
{
    //lista todas las categorias ordenadas por nombre alfabéticamente
    public static function listar()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT id, name, description FROM categories ORDER BY name ASC";
        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    //obtiene una categoria por su id
    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT id, name, description FROM categories WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }
    //crea una nueva categoria y la guarda en la base de datos
    public static function crear($name, $description)
    {
        $conn = Conexion::conectar();

        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);

        $sql = "INSERT INTO categories (name, description)
                VALUES ('$name', '$description')";

        return $conn->query($sql);
    }
    //actualiza una categoria existente con nuevos datos
    public static function actualizar($id, $name, $description)
    {
        $conn = Conexion::conectar();

        $id = (int)$id;
        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);

        $sql = "UPDATE categories 
                SET name='$name', description='$description'
                WHERE id=$id";

        return $conn->query($sql);
    }
    //elimina una categoria existente por su id
    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "DELETE FROM categories WHERE id=$id";

        return $conn->query($sql);
    }
}
?>