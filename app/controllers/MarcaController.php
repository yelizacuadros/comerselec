<?php
require_once __DIR__ . "/../models/Marca.php";

class MarcaController
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
        $descripcion = trim((string)($data['descripcion'] ?? ''));
        $pais = trim((string)($data['pais_origen'] ?? ''));

        if ($nombre === '' || mb_strlen($nombre) < 2) $errors[] = "El nombre de la marca es obligatorio y debe tener al menos 2 caracteres.";
        if ($descripcion === '') $errors[] = "La descripción es obligatoria.";
        if (mb_strlen($descripcion) > 255) $errors[] = "La descripción no puede superar 255 caracteres.";
        if ($pais === '' || mb_strlen($pais) < 2) $errors[] = "El país de origen es obligatorio y debe tener al menos 2 caracteres.";
        if (mb_strlen($pais) > 50) $errors[] = "El país de origen no puede superar 50 caracteres.";

        return $errors;
    }

    public function listar()
    {
        $this->verificarLogin();
        $marcas = Marca::listar();
        require_once __DIR__ . "/../views/admin/marcas.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $error = "";
        $marca = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'pais_origen' => trim($_POST['pais_origen'] ?? ''),
            ];
            $errors = $this->validarDatos($marca);
            if (empty($errors) && Marca::crear($marca['nombre'], $marca['descripcion'], $marca['pais_origen'])) {
                header("Location: index.php?url=admin/marcas");
                exit;
            }
            $error = implode(" ", $errors ?: ["La marca ya existe o no pudo guardarse."]);
        }
        require_once __DIR__ . "/../views/admin/marcas_form.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die('Error: ID no encontrado.');
        $error = "";
        $marca = Marca::obtenerPorId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = [
                'id_marca' => $id,
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'pais_origen' => trim($_POST['pais_origen'] ?? ''),
            ];
            $errors = $this->validarDatos($marca);
            if (empty($errors) && Marca::actualizar($id, $marca['nombre'], $marca['descripcion'], $marca['pais_origen'])) {
                header("Location: index.php?url=admin/marcas");
                exit;
            }
            $error = implode(" ", $errors ?: ["No fue posible actualizar la marca."]);
        }
        require_once __DIR__ . "/../views/admin/marcas_form.php";
    }

    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("Error: ID inválido.");
        }
        Marca::eliminar($id);
        header("Location: index.php?url=admin/marcas");
        exit;
    }
}
?>
