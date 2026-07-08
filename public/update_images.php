<?php
require_once __DIR__ . '/../app/config/conexion.php';

$conn = Conexion::conectar();
$res = $conn->query("SELECT id, name, image_url FROM products ORDER BY name ASC");

echo "<pre>";
echo "Este proyecto usa la base de datos como fuente de verdad para image_url.\n";
echo "Edita los enlaces desde la BD o desde el panel de productos.\n\n";

if ($res) {
    while ($row = $res->fetch_assoc()) {
        $image = $row['image_url'] ?: '[sin imagen]';
        echo "{$row['id']} | {$row['name']} | {$image}\n";
    }
}

echo "</pre>";
