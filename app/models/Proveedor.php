<?php
require_once __DIR__ . "/../config/conexion.php";

class Proveedor
{
    public static function listar()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT id_proveedor, nombre, telefono, correo, direccion 
                FROM proveedores 
                ORDER BY nombre ASC";
        $res = $conn->query($sql);

        $data = []; 
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //obtiene un proveedor por su id
    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT id_proveedor, nombre, telefono, correo, direccion 
                FROM proveedores 
                WHERE id_proveedor=$id LIMIT 1";
        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }

    //crea un nuevo proveedor y la guarda en la base de datos
    public static function crear($nombre, $telefono, $correo, $direccion)
    {
        $conn = Conexion::conectar();
        $nombre = $conn->real_escape_string($nombre);
        $telefono = $conn->real_escape_string($telefono);
        $correo = $conn->real_escape_string($correo);
        $direccion = $conn->real_escape_string($direccion);
        // Verificar que no exista otro proveedor con el mismo nombre
        $sqlVerificar = "   SELECT id_proveedor
                            FROM proveedores 
                            WHERE nombre='$nombre' 
                            LIMIT 1";

        $resultado = $conn->query($sqlVerificar);
        if ($resultado->num_rows > 0) {
            return false; // Proveedor ya existe
        }


        $sql = "INSERT INTO proveedores (nombre, telefono, correo, direccion)
                VALUES ('$nombre', '$telefono', '$correo', '$direccion')";

        return $conn->query($sql);
    }
    //actualiza un proveedor existente con nuevos datos
    public static function actualizar($id_proveedor, $nombre, $telefono, $correo, $direccion)
    {
        $conn = Conexion::conectar();

        $id_proveedor = (int)$id_proveedor;
        $nombre = $conn->real_escape_string($nombre);
        $telefono = $conn->real_escape_string($telefono);
        $correo = $conn->real_escape_string($correo);
        $direccion = $conn->real_escape_string($direccion);

        // Verificar que no exista otro proveedor con el mismo nombre
        $sqlVerificar = "   SELECT id_proveedor
                            FROM proveedores 
                            WHERE nombre='$nombre' 
                            AND id_proveedor != $id_proveedor
                            LIMIT 1";

        $resultado = $conn->query($sqlVerificar);
        if ($resultado->num_rows > 0) {
            return false; // Proveedor con el mismo nombre ya existe
        }

        $sql = "UPDATE proveedores 
                SET nombre='$nombre', telefono='$telefono', correo='$correo', direccion='$direccion'
                WHERE id_proveedor=$id_proveedor";

        return $conn->query($sql);
    }
    //elimina un proveedor existente por su id
    public static function eliminar($id_proveedor)
    {
        $conn = Conexion::conectar();
        $id_proveedor = (int)$id_proveedor;

        $sql = "DELETE FROM proveedores WHERE id_proveedor=$id_proveedor";

        return $conn->query($sql);
    }
    

}