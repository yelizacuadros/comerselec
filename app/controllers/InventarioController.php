<?php
require_once __DIR__ . "/../models/Inventario.php";
require_once __DIR__ . "/../models/Product.php";

class InventarioController
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

    private function validarDatos(array $data, bool $requiereProducto = true): array
    {
        $errors = [];

        if ($requiereProducto && (empty($data['id_producto']) || !is_numeric($data['id_producto']))) {
            $errors[] = "Debe seleccionar un producto válido.";
        }

        if (!isset($data['stock']) || !is_numeric($data['stock']) || (int)$data['stock'] < 0) {
            $errors[] = "El stock debe ser un número mayor o igual a 0.";
        }

        $ubicacion = trim((string)($data['ubicacion'] ?? ''));
        if ($ubicacion === '') {
            $errors[] = "La ubicación es obligatoria.";
        } elseif (mb_strlen($ubicacion) > 100) {
            $errors[] = "La ubicación no puede superar 100 caracteres.";
        }

        return $errors;
    }

    public function listar()
    {
        $this->verificarLogin();
        $inventario = Inventario::listar();
        require_once __DIR__ . "/../views/admin/inventario.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $error = "";
        $inventario = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inventario = [
                'id_producto' => $_POST['id_producto'] ?? '',
                'stock' => $_POST['stock'] ?? '',
                'ubicacion' => trim($_POST['ubicacion'] ?? ''),
            ];
            $errors = $this->validarDatos($inventario);
            if (empty($errors) && Inventario::crear($inventario['id_producto'], $inventario['stock'], $inventario['ubicacion'])) {
                header("Location: index.php?url=admin/inventario");
                exit;
            }
            $error = implode(" ", $errors ?: ["Este producto ya está registrado en el inventario."]);
        }
        $products = Product::listarDisponiblesInventario();
        require_once __DIR__ . "/../views/admin/inventario_form.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die("ID no encontrado");
        $error = "";
        $inventario = Inventario::obtenerPorId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inventario = [
                'id_producto' => $_POST['id_producto'] ?? '',
                'stock' => $_POST['stock'] ?? '',
                'ubicacion' => trim($_POST['ubicacion'] ?? ''),
            ];
            $errors = $this->validarDatos($inventario, false);
            if (empty($errors) && Inventario::actualizar($id, $inventario['id_producto'], $inventario['stock'], $inventario['ubicacion'])) {
                header("Location: index.php?url=admin/inventario");
                exit;
            }
            $error = implode(" ", $errors ?: ["No fue posible actualizar el inventario."]);
        }
        $products = Product::listar();
        require_once __DIR__ . "/../views/admin/inventario_form.php";
    }

    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die("ID no encontrado");
        Inventario::eliminar($id);
        header("Location: index.php?url=admin/inventario");
        exit;
    }
}
?>
