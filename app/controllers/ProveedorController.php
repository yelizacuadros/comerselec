<?php
require_once __DIR__ . "/../models/Proveedor.php";

class ProveedorController
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
        $nombre = trim((string)($data['nombre'] ?? ''));
        $telefono = trim((string)($data['telefono'] ?? ''));
        $correo = trim((string)($data['correo'] ?? ''));
        $direccion = trim((string)($data['direccion'] ?? ''));

        if ($nombre === '' || mb_strlen($nombre) < 2) $errors[] = "El nombre del proveedor es obligatorio y debe tener al menos 2 caracteres.";
        if ($telefono === '' || !preg_match('/^[0-9+\-\s()]{7,20}$/', $telefono)) $errors[] = "El teléfono debe tener un formato válido.";
        if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) $errors[] = "El correo debe tener un formato válido.";
        if ($direccion === '') $errors[] = "La dirección es obligatoria.";
        if (mb_strlen($direccion) > 255) $errors[] = "La dirección no puede superar 255 caracteres.";

        return $errors;
    }

    public function listar()
    {
        $this->verificarLogin();
        $proveedores = Proveedor::listar();
        require_once __DIR__ . "/../views/admin/proveedores.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $error = "";
        $proveedor = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedor = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? ''),
                'correo' => trim($_POST['correo'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
            ];
            $errors = $this->validarDatos($proveedor);
            if (empty($errors) && Proveedor::crear($proveedor['nombre'], $proveedor['telefono'], $proveedor['correo'], $proveedor['direccion'])) {
                header("Location: index.php?url=admin/proveedores");
                exit;
            }
            $error = implode(" ", $errors ?: ["El proveedor ya existe o no pudo guardarse."]);
        }
        require_once __DIR__ . "/../views/admin/proveedores_form.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $error = "";
        $proveedor = Proveedor::obtenerPorId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedor = [
                'id_proveedor' => $id,
                'nombre' => trim($_POST['nombre'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? ''),
                'correo' => trim($_POST['correo'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
            ];
            $errors = $this->validarDatos($proveedor);
            if (empty($errors) && Proveedor::actualizar($id, $proveedor['nombre'], $proveedor['telefono'], $proveedor['correo'], $proveedor['direccion'])) {
                header("Location: index.php?url=admin/proveedores");
                exit;
            }
            $error = implode(" ", $errors ?: ["No fue posible actualizar el proveedor."]);
        }
        require_once __DIR__ . "/../views/admin/proveedores_form.php";
    }

    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("Error: ID inválido.");
        }
        Proveedor::eliminar($id);
        header("Location: index.php?url=admin/proveedores");
        exit;
    }
}
?>
