<?php
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Marca.php";
require_once __DIR__ . "/../models/Proveedor.php";

class ProductController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }

    private function validarDatos(array $data): array
    {
        $errors = [];

        if (empty($data['category_id']) || !is_numeric($data['category_id'])) {
            $errors[] = "Debe seleccionar una categoría válida.";
        }

        if (empty($data['id_marca']) || !is_numeric($data['id_marca'])) {
            $errors[] = "Debe seleccionar una marca válida.";
        }

        if (empty($data['id_proveedor']) || !is_numeric($data['id_proveedor'])) {
            $errors[] = "Debe seleccionar un proveedor válido.";
        }

        $name = trim((string)($data['name'] ?? ''));
        if ($name === '') {
            $errors[] = "El nombre del producto es obligatorio.";
        } elseif (mb_strlen($name) < 2) {
            $errors[] = "El nombre del producto debe tener al menos 2 caracteres.";
        } elseif (mb_strlen($name) > 150) {
            $errors[] = "El nombre del producto no puede superar 150 caracteres.";
        }

        $description = trim((string)($data['description'] ?? ''));
        if (mb_strlen($description) > 500) {
            $errors[] = "La descripción no puede superar 500 caracteres.";
        }

        $price = $data['price'] ?? '';
        if ($price === '' || !is_numeric($price) || (float)$price < 0) {
            $errors[] = "El precio debe ser un número mayor o igual a 0.";
        }

        $imageUrl = trim((string)($data['image_url'] ?? ''));
        if ($imageUrl !== '' && !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            $errors[] = "La URL de la imagen no tiene un formato válido.";
        }

        return $errors;
    }

    public function listar()
    {
        $this->verificarLogin();
        $products = Product::listar();
        require_once __DIR__ . "/../views/admin/products.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $errors = [];
        $product = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = [
                'category_id' => $_POST['category_id'] ?? '',
                'id_marca' => $_POST['id_marca'] ?? '',
                'id_proveedor' => $_POST['id_proveedor'] ?? '',
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'price' => $_POST['price'] ?? '',
                'image_url' => trim($_POST['image_url'] ?? ''),
            ];

            $errors = $this->validarDatos($product);

            if (empty($errors) && Product::crear($product['category_id'], $product['id_marca'], $product['id_proveedor'], $product['name'], $product['description'], $product['price'], $product['image_url'])) {
                header("Location: index.php?url=admin/productos");
                exit;
            }

            if (empty($errors)) {
                $errors[] = "No fue posible guardar el producto.";
            }
        }

        $categories = Category::listar();
        $marcas = Marca::listar();
        $proveedores = Proveedor::listar();
        require_once __DIR__ . "/../views/admin/products_form.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $errors = [];
        $product = Product::obtenerPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = array_merge($product ?? [], [
                'category_id' => $_POST['category_id'] ?? '',
                'id_marca' => $_POST['id_marca'] ?? '',
                'id_proveedor' => $_POST['id_proveedor'] ?? '',
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'price' => $_POST['price'] ?? ($product['price'] ?? ''),
                'image_url' => trim($_POST['image_url'] ?? ''),
            ]);

            $errors = $this->validarDatos($product);

            if (empty($errors) && Product::actualizar($id, $product['category_id'], $product['id_marca'], $product['id_proveedor'], $product['name'], $product['description'], $product['price'], $product['image_url'])) {
                header("Location: index.php?url=admin/productos");
                exit;
            }

            if (empty($errors)) {
                $errors[] = "No fue posible actualizar el producto.";
            }
        }

        $categories = Category::listar();
        $marcas = Marca::listar();
        $proveedores = Proveedor::listar();
        require_once __DIR__ . "/../views/admin/products_form.php";
    }

    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        Product::eliminar($id);
        header("Location: index.php?url=admin/productos");
        exit;
    }
}
?>
