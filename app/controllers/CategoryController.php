<?php
require_once __DIR__ . "/../models/Category.php";

class CategoryController
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
        $name = trim((string)($data['name'] ?? ''));
        $description = trim((string)($data['description'] ?? ''));

        if ($name === '') {
            $errors[] = "El nombre de la categoría es obligatorio.";
        } elseif (mb_strlen($name) < 2) {
            $errors[] = "El nombre de la categoría debe tener al menos 2 caracteres.";
        } elseif (mb_strlen($name) > 100) {
            $errors[] = "El nombre de la categoría no puede superar 100 caracteres.";
        }

        if (mb_strlen($description) > 255) {
            $errors[] = "La descripción no puede superar 255 caracteres.";
        }

        return $errors;
    }

    public function listar()
    {
        $this->verificarLogin();
        $categories = Category::listar();
        require_once __DIR__ . "/../views/admin/categories.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $error = "";
        $category = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ];
            $errors = $this->validarDatos($category);

            if (empty($errors) && Category::crear($category['name'], $category['description'])) {
                header("Location: index.php?url=admin/categorias");
                exit;
            }

            $error = implode(" ", $errors ?: ["No fue posible guardar la categoría."]);
        }

        require_once __DIR__ . "/../views/admin/categories_form.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $error = "";
        $category = Category::obtenerPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = [
                'id' => $id,
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ];
            $errors = $this->validarDatos($category);

            if (empty($errors) && Category::actualizar($id, $category['name'], $category['description'])) {
                header("Location: index.php?url=admin/categorias");
                exit;
            }

            $error = implode(" ", $errors ?: ["No fue posible actualizar la categoría."]);
        }

        require_once __DIR__ . "/../views/admin/categories_form.php";
    }

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
