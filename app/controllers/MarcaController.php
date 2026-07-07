<?php
require_once __DIR__ . "/../models/Marca.php";

class MarcaController
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

    // lista todas las marcas y las muestra en el panel de administración
    public function listar()
    {
        $this->verificarLogin();

        $marcas = Marca::listar();

        require_once __DIR__ . "/../views/admin/marcas.php";
    }

    // crea una nueva marca y la almacena en la base de datos
    public function crear()
    {
        $this->verificarLogin();
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre'] ?? "");  //trim para eliminar espacios en blanco al inicio y al final
            $descripcion = trim($_POST['descripcion'] ?? "");
            $pais_origen = trim($_POST['pais_origen'] ?? "");

            // validar campos vacíos
            if (empty($nombre) || empty($descripcion) || empty($pais_origen)) {

                $error = "Todos los campos son obligatorios.";

            } elseif (Marca::crear($nombre, $descripcion, $pais_origen)) {

                header("Location: index.php?url=admin/marcas");
                exit;

            } else {

                $error = "La marca ya existe.";

            }
        }


        require_once __DIR__ . "/../views/admin/marcas_form.php";
    }

    // edita una marca existente
    public function editar()
    {
        $this->verificarLogin();

        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre'] ?? "");
            $descripcion = trim($_POST['descripcion'] ?? "");
            $pais_origen = trim($_POST['pais_origen'] ?? "");

            // validar campos vacíos
            if (empty($nombre) || empty($descripcion) || empty($pais_origen)) {

                $error = "Todos los campos son obligatorios.";

            } elseif (Marca::actualizar($id, $nombre, $descripcion, $pais_origen)) {

                header("Location: index.php?url=admin/marcas");
                exit;
            } else {
                $error = "Ya existe otra marca con ese nombre.";
            }

        } else {

            $marca = Marca::obtenerPorId($id);
        }
        require_once __DIR__ . "/../views/admin/marcas_form.php";
    }

    // elimina una marca existente por su id
    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            die("Error: ID no válido.");
        }
        Marca::eliminar($id);
        header("Location: index.php?url=admin/marcas");
        exit;
    }
}
?>