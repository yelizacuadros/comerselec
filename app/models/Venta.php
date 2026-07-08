<?php
require_once __DIR__ . "/../config/conexion.php";

class Venta
{
    public static function listar($limit = 10)
    {
        $conn = Conexion::conectar();
        $limit = (int)$limit;

        $sql = "SELECT id_venta, cliente, total, fecha_venta
                FROM ventas
                ORDER BY fecha_venta DESC
                LIMIT $limit";
        $res = $conn->query($sql);
        if (!$res) {
            return [];
        }

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public static function crear($cliente, $detalle, $total)
    {
        $conn = Conexion::conectar();
        $cliente = $conn->real_escape_string($cliente);
        $detalle = $conn->real_escape_string($detalle);
        $total = (float)$total;

        $sql = "INSERT INTO ventas (cliente, detalle, total) VALUES ('$cliente', '$detalle', $total)";
        return $conn->query($sql);
    }

    public static function resumen()
    {
        $conn = Conexion::conectar();
        $ventas = $conn->query("SELECT COUNT(*) AS total_ventas, COALESCE(SUM(total),0) AS total_facturado FROM ventas");
        return $ventas ? $ventas->fetch_assoc() : ['total_ventas' => 0, 'total_facturado' => 0];
    }
}
