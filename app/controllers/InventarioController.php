<?php
require_once __DIR__ . "/../models/Inventario.php";
require_once __DIR__ . "/../models/Product.php";

class InventarioController
{
    // Constructor que inicia la sesión
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    //protege las rutas
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }

    //lista el inventario
    public function listar()
    {
        $this->verificarLogin();
        $inventario = Inventario::listar();
        require_once __DIR__ . "/../views/admin/inventario.php";
    }

    //crea un registro de inventario
    public function crear()
    {
        $this->verificarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_producto = $_POST['id_producto'] ?? "";
            $stock = $_POST['stock'] ?? "";
            $ubicacion = $_POST['ubicacion'] ?? "";

            if (Inventario::crear($id_producto, $stock, $ubicacion)) {
                header("Location: index.php?url=admin/inventario");
                exit;
            } else {
                echo "<script>
                        alert('Este producto ya está registrado en el inventario.');
                        window.location='index.php?url=admin/inventario_crear';
                    </script>";
                exit;
            }
        }

        $products = Product::listarDisponiblesInventario();
        require_once __DIR__ . "/../views/admin/inventario_form.php";
    }

    //edita un registro
    public function editar()
    {
        $this->verificarLogin();

        $id = $_GET['id'] ?? die("ID no encontrado");

        $inventario = Inventario::obtenerPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_producto = $_POST['id_producto'] ?? "";
            $stock = $_POST['stock'] ?? "";
            $ubicacion = $_POST['ubicacion'] ?? "";

            if (Inventario::actualizar($id, $id_producto, $stock, $ubicacion)) {
                header("Location: index.php?url=admin/inventario");
                exit;
            }
        }

        $products = Product::listar();
        require_once __DIR__ . "/../views/admin/inventario_form.php";
    }

    //elimina un registro
    public function eliminar()
    {
        $this->verificarLogin();

        $id = $_GET['id'] ?? die("ID no encontrado");

        Inventario::eliminar($id);

        header("Location: index.php?url=admin/inventario");
        exit;
    }
}