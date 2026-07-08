<?php
require_once __DIR__ . "/../config/conexion.php";

class Venta
{
    public static function listar($limit = 10)
    {
        $conn = Conexion::conectar();
        $limit = (int)$limit;

        $sql = "SELECT v.id_venta, v.cliente, v.total, v.fecha_venta,
                       COUNT(d.id_detalle) AS items
                FROM ventas v
                LEFT JOIN venta_detalle d ON v.id_venta = d.id_venta
                GROUP BY v.id_venta
                ORDER BY v.fecha_venta DESC
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

    public static function resumen()
    {
        $conn = Conexion::conectar();
        $ventas = $conn->query("SELECT COUNT(*) AS total_ventas, COALESCE(SUM(total),0) AS total_facturado FROM ventas");
        return $ventas ? $ventas->fetch_assoc() : ['total_ventas' => 0, 'total_facturado' => 0];
    }

    public static function productosDisponibles()
    {
        $conn = Conexion::conectar();
        $sql = "SELECT p.id, p.name, p.price, i.stock
                FROM products p
                INNER JOIN inventario i ON p.id = i.id_producto
                WHERE i.stock > 0
                ORDER BY p.name ASC";
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

    public static function crearConDetalle($cliente, array $items)
    {
        $conn = Conexion::conectar();
        $cliente = $conn->real_escape_string($cliente);

        if (empty($items)) {
            return ['ok' => false, 'error' => 'Debe agregar al menos un producto.'];
        }

        $conn->begin_transaction();

        try {
            $total = 0;
            $detalleTexto = [];

            foreach ($items as $item) {
                $productId = (int)($item['id_producto'] ?? 0);
                $cantidad = (int)($item['cantidad'] ?? 0);
                if ($productId <= 0 || $cantidad <= 0) {
                    throw new Exception('Producto o cantidad inválidos');
                }

                $stmt = $conn->prepare("SELECT p.name, p.price, i.stock FROM products p INNER JOIN inventario i ON p.id = i.id_producto WHERE p.id = ? LIMIT 1");
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $res = $stmt->get_result();
                $product = $res ? $res->fetch_assoc() : null;
                $stmt->close();

                if (!$product) {
                    throw new Exception('Producto no encontrado');
                }

                $stockActual = (int)$product['stock'];
                if ($stockActual < $cantidad) {
                    throw new Exception('Stock insuficiente para ' . $product['name'] . '. Disponible: ' . $stockActual);
                }

                $precio = (float)$product['price'];
                $subtotal = $precio * $cantidad;
                $total += $subtotal;
                $detalleTexto[] = $cantidad . ' x ' . $product['name'];

                $stmt = $conn->prepare("UPDATE inventario SET stock = stock - ? WHERE id_producto = ?");
                $stmt->bind_param('ii', $cantidad, $productId);
                if (!$stmt->execute()) {
                    throw new Exception('No se pudo actualizar inventario');
                }
                $stmt->close();
            }

            $detalle = implode(', ', $detalleTexto);
            $stmt = $conn->prepare("INSERT INTO ventas (cliente, detalle, total) VALUES (?, ?, ?)");
            $stmt->bind_param('ssd', $cliente, $detalle, $total);
            if (!$stmt->execute()) {
                throw new Exception('No se pudo registrar la venta');
            }
            $ventaId = $stmt->insert_id;
            $stmt->close();

            foreach ($items as $item) {
                $productId = (int)$item['id_producto'];
                $cantidad = (int)$item['cantidad'];

                $stmt = $conn->prepare("SELECT p.price FROM products p WHERE p.id = ? LIMIT 1");
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $res = $stmt->get_result();
                $product = $res ? $res->fetch_assoc() : null;
                $stmt->close();

                $precio = (float)($product['price'] ?? 0);
                $subtotal = $precio * $cantidad;

                $stmt = $conn->prepare("INSERT INTO venta_detalle (id_venta, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('iiidd', $ventaId, $productId, $cantidad, $precio, $subtotal);
                if (!$stmt->execute()) {
                    throw new Exception('No se pudo registrar el detalle');
                }
                $stmt->close();
            }

            $conn->commit();
            return ['ok' => true];
        } catch (Throwable $e) {
            $conn->rollback();
            error_log((string)$e);
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }
}
