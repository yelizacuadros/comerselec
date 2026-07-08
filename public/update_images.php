<?php
/**
 * Script para actualizar image_url de productos en la base de datos.
 * Asigna imágenes según palabras clave en el nombre del producto.
 * Ejecutar una sola vez desde: http://localhost/comerselec-1/public/update_images.php
 */
require_once __DIR__ . "/../app/config/conexion.php";

$conn = Conexion::conectar();

// Mapa de palabras clave → imagen (relativas a /public/)
$imageMap = [
    'thhn'           => 'img/prod_cable_thhn.png',
    'cable thhn'     => 'img/prod_cable_thhn.png',
    'concentrico'    => 'img/prod_cable_concentrico.png',
    'conc'           => 'img/prod_cable_concentrico.png',
    'contraincendio' => 'img/prod_cable_thhn.png',
    'foco led'       => 'img/prod_foco_led.png',
    'led 9w'         => 'img/prod_foco_led.png',
    'reflector'      => 'img/prod_panel_led.png',
    'panel led'      => 'img/prod_panel_led.png',
    'panel'          => 'img/prod_panel_led.png',
    'lámpara'        => 'img/prod_foco_led.png',
    'lampara'        => 'img/prod_foco_led.png',
    'iluminacion'    => 'img/prod_foco_led.png',
    'breaker'        => 'img/prod_breaker.png',
    'interruptor'    => 'img/prod_breaker.png',
    'tablero'        => 'img/prod_breaker.png',
    'taladro'        => 'img/prod_breaker.png',
    'cable'          => 'img/prod_cable_thhn.png',
];

$products = $conn->query("SELECT id, name FROM products");
$updated = 0;
$skipped = 0;
$log = [];

while ($row = $products->fetch_assoc()) {
    $nameLower = mb_strtolower($row['name']);
    $assigned  = null;

    foreach ($imageMap as $keyword => $img) {
        if (strpos($nameLower, $keyword) !== false) {
            $assigned = $img;
            break;
        }
    }

    if ($assigned) {
        $safe = $conn->real_escape_string($assigned);
        $conn->query("UPDATE products SET image_url='$safe' WHERE id={$row['id']}");
        $log[] = "✅ ID {$row['id']}: {$row['name']} → $assigned";
        $updated++;
    } else {
        $log[] = "⚠️  ID {$row['id']}: {$row['name']} → sin imagen asignada";
        $skipped++;
    }
}

echo "<pre>";
echo "=== Actualización de imágenes de productos ===\n\n";
foreach ($log as $l) echo $l . "\n";
echo "\n✔ Actualizados: $updated | Sin imagen: $skipped\n";
echo "\nYa puedes eliminar este archivo.";
echo "</pre>";
?>
