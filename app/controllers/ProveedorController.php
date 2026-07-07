<?php
require_once __DIR__ . "/../models/Proveedor.php";

class ProveedorController
{
    // constructor que inicia la sesión si no está iniciada
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // protege las rutas, redirigiendo al login si el usuario no ha iniciado sesión
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }

    // lista todos las proveedores y las muestra en el panel de administración
    public function listar()
    {
        $this->verificarLogin(); 

        $proveedores = Proveedor::listar();

        require_once __DIR__ . "/../views/admin/proveedores.php";
    }

    // crea un nuevo proveedor y la almacena en la base de datos
    public function crear()
    {
        $this->verificarLogin();
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre'] ?? "");  //trim para eliminar espacios en blanco al inicio y al final
            $telefono = trim($_POST['telefono'] ?? "");
            $correo = trim($_POST['correo'] ?? "");
            $direccion = trim($_POST['direccion'] ?? "");

            // validar campos vacíos
            if (empty($nombre) || empty($telefono) || empty($correo) || empty($direccion)) {

                $error = "Todos los campos son obligatorios."; 

            } elseif (Proveedor::crear($nombre, $telefono, $correo, $direccion)) {

                header("Location: index.php?url=admin/proveedores");
                exit;

            } else {

                $error = "El proveedor ya existe.";

            }
        }


        require_once __DIR__ . "/../views/admin/proveedores_form.php";
    }

    // edita un proveedor existente
    public function editar()
    {
        $this->verificarLogin();

        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre'] ?? "");
            $telefono = trim($_POST['telefono'] ?? "");
            $correo = trim($_POST['correo'] ?? "");
            $direccion = trim($_POST['direccion'] ?? "");

            // validar campos vacíos
            if (empty($nombre) || empty($telefono) || empty($correo) || empty($direccion)) {

                $error = "Todos los campos son obligatorios.";

            } elseif (Proveedor::actualizar($id, $nombre, $telefono, $correo, $direccion)) {

                header("Location: index.php?url=admin/proveedores");
                exit;
            } else {
                $error = "Ya existe otro proveedor con ese nombre.";
            }

        } else {

            $proveedor = Proveedor::obtenerPorId($id);
        }
        require_once __DIR__ . "/../views/admin/proveedores_form.php";
    }

    // elimina un proveedor existente por su id
    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            die("Error: ID no válido.");
        }
        Proveedor::eliminar($id);
        header("Location: index.php?url=admin/proveedores");
        exit;
    }
}