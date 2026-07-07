<?php
require_once __DIR__ . "/../models/Category.php";

class CategoryController
{
    // Constructor que inicia la sesión si no está iniciada
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
    //lista todas las categorías y las muestra en el panel de administración
    public function listar()
    {
        $this->verificarLogin();
        $categories = Category::listar();
        require_once __DIR__ . "/../views/admin/categories.php";
    }
    //crea una nueva categoria y la almacena en la base de datos 
    public function crear()
    {
        $this->verificarLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? "";
            $description = $_POST['description'] ?? "";
            if (Category::crear($name, $description)) {
                header("Location: index.php?url=admin/categorias");
                exit;
            }
        }
        require_once __DIR__ . "/../views/admin/categories_form.php";
    }
    //edita una categoria existente
    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? "";
            $description = $_POST['description'] ?? "";
            if (Category::actualizar($id, $name, $description)) {
                header("Location: index.php?url=admin/categorias");
                exit;
            }
        } else {
            $category = Category::obtenerPorId($id);
        }
        require_once __DIR__ . "/../views/admin/categories_form.php";
    }
    //elimina una categoria existente por su id
    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        Category::eliminar($id);
        header("Location: index.php?url=admin/categorias");
        exit;
    }
}
?>