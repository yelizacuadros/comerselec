<?php
require_once __DIR__ . "/../config/conexion.php";

class Product
{
    //lista todos los productos con sus categorias asociadas  
    public static function listar(){
        $conn = Conexion::conectar();

        $sql = "SELECT p.id,
                    p.name,
                    p.description,
                    p.price,
                    p.image_url,
                    c.name AS category_name,
                    m.nombre AS marca,
                    pr.nombre AS proveedor,
                    i.stock
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN marcas m ON p.id_marca = m.id_marca
                LEFT JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
                LEFT JOIN inventario i ON p.id = i.id_producto
                ORDER BY p.name ASC";

        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }


    //lista productos filtrados por categoria, mostrando el nombre de la categoria asociada
    public static function listarPorCategoria($category_id)
    {
        $conn = Conexion::conectar();
        $category_id = (int)$category_id;

        $sql = "SELECT p.id, p.name, p.description, p.price,
                    p.image_url,
                    c.name AS category_name,
                    m.nombre AS marca,
                    pr.nombre AS proveedor
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN marcas m ON p.id_marca = m.id_marca
                LEFT JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
                WHERE p.category_id = $category_id
                ORDER BY p.name ASC";

        $res = $conn->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //busca productos por palabra clave en nombre o descripcion
    public static function buscarPorPalabra($keyword)
    {
        $conn = Conexion::conectar();
        $keyword = $conn->real_escape_string($keyword);

        $sql = "SELECT p.id, p.name, p.description, p.price, p.image_url,
                    c.name AS category_name,
                    m.nombre AS marca,
                    pr.nombre AS proveedor,
                    i.stock
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN marcas m ON p.id_marca = m.id_marca
                LEFT JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
                LEFT JOIN inventario i ON p.id = i.id_producto
                WHERE p.name LIKE '%$keyword%'
                   OR p.description LIKE '%$keyword%'
                   OR c.name LIKE '%$keyword%'
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




    //crea un nuevo producto y lo guarda en la base de datos
    public static function crear($category_id, $id_marca, $id_proveedor, $name, $description, $price, $image_url)
    {
        $conn = Conexion::conectar();

        $category_id = (int)$category_id;
        $id_marca = (int)$id_marca;
        $id_proveedor = (int)$id_proveedor;

        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);
        $price = $conn->real_escape_string($price);
        $image_url = $conn->real_escape_string($image_url);

        $sql = "INSERT INTO products
        (category_id, id_marca, id_proveedor, name, description, price, image_url)
        VALUES
        ($category_id, $id_marca, $id_proveedor, '$name', '$description', '$price', '$image_url')";

        return $conn->query($sql);
    }


    //obtiene un producto por su id, mostrando todos sus detalles
    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "SELECT * FROM products WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }


    //actualiza un producto existente con nuevos datos
    public static function actualizar($id, $category_id, $id_marca, $id_proveedor, $name, $description, $price, $image_url)
    {
        $conn = Conexion::conectar();

        $id = (int)$id;
        $category_id = (int)$category_id;
        $id_marca = (int)$id_marca;
        $id_proveedor = (int)$id_proveedor;

        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);
        $price = $conn->real_escape_string($price);
        $image_url = $conn->real_escape_string($image_url);

        $sql = "UPDATE products SET
                    category_id=$category_id,
                    id_marca=$id_marca,
                    id_proveedor=$id_proveedor,
                    name='$name',
                    description='$description',
                    price='$price',
                    image_url='$image_url'
                WHERE id=$id";

        return $conn->query($sql);
    }


    //elimina un producto existente por su id
    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;

        $sql = "DELETE FROM products WHERE id=$id";

        return $conn->query($sql);
    }

    
    //lista los productos que aún no están registrados en inventario
    public static function listarDisponiblesInventario()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT p.id, p.name, p.description, p.price, p.image_url,
                    c.name AS category_name
                FROM products p
                LEFT JOIN inventario i ON p.id = i.id_producto
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE i.id_inventario IS NULL
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
}
?>
