<?php
require_once __DIR__ . "/../config/conexion.php";

class Inventario
{
    //lista todos los registros del inventario
    public static function listar(){
        $conn = Conexion::conectar();

        $sql = "SELECT i.id_inventario,
                    i.id_producto,
                    i.stock,
                    i.ubicacion,
                    p.name,
                    p.price,
                    c.name AS categoria,
                    m.nombre AS marca,
                    pr.nombre AS proveedor
                FROM inventario i
                INNER JOIN products p ON i.id_producto = p.id
                INNER JOIN categories c ON p.category_id = c.id
                INNER JOIN marcas m ON p.id_marca = m.id_marca
                INNER JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
                ORDER BY p.name ASC";

        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //obtiene un registro del inventario por su id
    public static function obtenerPorId($id){
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT i.*, p.name
                FROM inventario i
                INNER JOIN products p
                    ON i.id_producto = p.id
                WHERE i.id_inventario=$id
                LIMIT 1";

        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }

    
    //crea un nuevo registro de inventario
    public static function crear($id_producto, $stock, $ubicacion){
        $conn = Conexion::conectar();

        $id_producto = (int)$id_producto;
        $stock = (int)$stock;
        $ubicacion = $conn->real_escape_string($ubicacion);

        // Verificar que el producto no exista en inventario
        $sqlVerificar = "SELECT id_inventario
                        FROM inventario
                        WHERE id_producto=$id_producto
                        LIMIT 1";

        $resultado = $conn->query($sqlVerificar);

        if ($resultado->num_rows > 0) {
            return false; // Ya existe
        }

        $sql = "INSERT INTO inventario (id_producto, stock, ubicacion)
                VALUES ($id_producto, $stock, '$ubicacion')";

        return $conn->query($sql);
    }

    //actualiza un registro del inventario
    public static function actualizar($id_inventario, $id_producto, $stock, $ubicacion)
    {
        $conn = Conexion::conectar();

        $id_inventario = (int)$id_inventario;
        $id_producto = (int)$id_producto;
        $stock = (int)$stock;
        $ubicacion = $conn->real_escape_string($ubicacion);

        $sql = "UPDATE inventario
                SET
                    id_producto=$id_producto,
                    stock=$stock,
                    ubicacion='$ubicacion'
                WHERE id_inventario=$id_inventario";

        return $conn->query($sql);
    }

    //elimina un registro del inventario
    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "DELETE FROM inventario
                WHERE id_inventario=$id";

        return $conn->query($sql);
    }
}
?>