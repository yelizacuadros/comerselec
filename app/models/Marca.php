<?php
require_once __DIR__ . "/../config/conexion.php";

class Marca
{
    public static function listar()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT id_marca, nombre, descripcion, pais_origen 
                FROM marcas 
                ORDER BY nombre ASC";
        $res = $conn->query($sql);

        $data = []; 
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //obtiene una marca por su id
    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT id_marca, nombre, descripcion, pais_origen 
                FROM marcas 
                WHERE id_marca=$id LIMIT 1";
        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }

    //crea una nueva marca y la guarda en la base de datos
    public static function crear($nombre, $descripcion, $pais_origen)
    {
        $conn = Conexion::conectar();
        $nombre = $conn->real_escape_string($nombre);
        $descripcion = $conn->real_escape_string($descripcion);
        $pais_origen = $conn->real_escape_string($pais_origen);
        // Verificar que no exista otra marca con el mismo nombre
        $sqlVerificar = "   SELECT id_marca
                            FROM marcas 
                            WHERE nombre='$nombre' 
                            LIMIT 1";

        $resultado = $conn->query($sqlVerificar);
        if ($resultado->num_rows > 0) {
            return false; // Marca ya existe
        }


        $sql = "INSERT INTO marcas (nombre, descripcion, pais_origen)
                VALUES ('$nombre', '$descripcion', '$pais_origen')";

        return $conn->query($sql);
    }
    //actualiza una marca existente con nuevos datos
    public static function actualizar($id_marca, $nombre, $descripcion, $pais_origen)
    {
        $conn = Conexion::conectar();

        $id_marca = (int)$id_marca;
        $nombre = $conn->real_escape_string($nombre);
        $descripcion = $conn->real_escape_string($descripcion);
        $pais_origen = $conn->real_escape_string($pais_origen);

        // Verificar que no exista otra marca con el mismo nombre
        $sqlVerificar = "   SELECT id_marca
                            FROM marcas 
                            WHERE nombre='$nombre' 
                            AND id_marca != $id_marca
                            LIMIT 1";

        $resultado = $conn->query($sqlVerificar);
        if ($resultado->num_rows > 0) {
            return false; // Marca con el mismo nombre ya existe
        }

        $sql = "UPDATE marcas 
                SET nombre='$nombre', descripcion='$descripcion', pais_origen='$pais_origen'
                WHERE id_marca=$id_marca";

        return $conn->query($sql);
    }
    //elimina una marca existente por su id
    public static function eliminar($id_marca)
    {
        $conn = Conexion::conectar();
        $id_marca = (int)$id_marca;

        $sql = "DELETE FROM marcas WHERE id_marca=$id_marca";

        return $conn->query($sql);
    }
    

}