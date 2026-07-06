<?php
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Category.php";

class ProductController
{
    // Constructor que inicia la sesión 
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
    }
    //protege las rutas, redirigiendo al login si el usuario no ha iniciado sesión
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }
    //lista todos los productos y los muestra en el panel de administración
    public function listar()
    {
        $this->verificarLogin();
        $products = Product::listar();
        require_once __DIR__ . "/../views/admin/products.php";
    }
    //crea un nuevo producto, mostrando un formulario y procesando los datos enviados por POST
    public function crear()
    {
        $this->verificarLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'] ?? "";
            $name = $_POST['name'] ?? "";
            $description = $_POST['description'] ?? "";
            $price = $_POST['price'] ?? "";
            $stock = $_POST['stock'] ?? "";
            $image_url = $_POST['image_url'] ?? "";
            
            if (Product::crear($category_id, $name, $description, $price, $stock, $image_url)) {
                header("Location: index.php?url=admin/productos");
                exit;
            }
        }
        $categories = Category::listar();
        require_once __DIR__ . "/../views/admin/products_form.php";
    }
    //permite editar un producto existente 
    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $product = Product::obtenerPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'] ?? "";
            $name = $_POST['name'] ?? "";
            $description = $_POST['description'] ?? "";
            $stock = $_POST['stock'] ?? "";
            $image_url = $_POST['image_url'] ?? "";
            // Si el usuario tiene el rol "Ventas", no permitir cambiar el precio
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Ventas') {
                $price = $product['price'];
            } else {
                $price = $_POST['price'] ?? "";
            }

            if (Product::actualizar($id, $category_id, $name, $description, $price, $stock, $image_url)) {
                header("Location: index.php?url=admin/productos");
                exit;
            }
        }
        
        $categories = Category::listar();
        require_once __DIR__ . "/../views/admin/products_form.php";
    }

    //elimina un producto existente por si id
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