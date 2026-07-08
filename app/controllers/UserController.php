<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Venta.php";

class UserController
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

    private function validarCredenciales(string $username, string $password): array
    {
        $errors = [];
        if ($username === '') $errors[] = "El nombre de usuario es obligatorio.";
        if (mb_strlen($username) < 3) $errors[] = "El nombre de usuario debe tener al menos 3 caracteres.";
        if ($password === '' || mb_strlen($password) < 4) $errors[] = "La contraseña debe tener al menos 4 caracteres.";
        return $errors;
    }

    public function iniciarSesion()
    {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? "");
            $password = $_POST['password'] ?? "";
            $errors = $this->validarCredenciales($username, $password);
            if (empty($errors)) {
                $user = User::login($username, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php?url=admin/panel");
                    exit;
                }
            }
            $error = implode(" ", $errors ?: ["Usuario o contraseña incorrectos."]);
        }
        require_once __DIR__ . "/../views/admin/login.php";
    }

    public function registrar()
    {
        $this->verificarLogin();
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? "");
            $password = $_POST['password'] ?? "";
            $errors = $this->validarCredenciales($username, $password);
            if (empty($errors)) {
                $resultado = User::registrar($username, $password);
                if ($resultado == "ok") {
                    $success = "Usuario registrado correctamente.";
                } else {
                    $error = $resultado;
                }
            } else {
                $error = implode(" ", $errors);
            }
        }
        require_once __DIR__ . "/../views/admin/register.php";
    }

    public function panelPrincipal()
    {
        $this->verificarLogin();
        $products = Product::listar();
        $categories = Category::listar();
        $salesSummary = Venta::resumen();
        $recentSales = Venta::listar(5);
        require_once __DIR__ . "/../views/admin/dashboard.php";
    }

    public function ventas()
    {
        $this->verificarLogin();
        $salesSummary = Venta::resumen();
        $recentSales = Venta::listar(10);
        $products = Venta::productosDisponibles();
        require_once __DIR__ . "/../views/admin/ventas.php";
    }

    public function facturacion()
    {
        $this->verificarLogin();
        $salesSummary = Venta::resumen();
        $recentSales = Venta::listar(10);
        require_once __DIR__ . "/../views/admin/facturas.php";
    }

    public function listar()
    {
        $this->verificarLogin();
        $usuarios = User::listar();
        require_once __DIR__ . "/../views/admin/usuarios.php";
    }

    public function crear()
    {
        $this->verificarLogin();
        $error = "";
        $usuario = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = [
                'username' => trim($_POST['username'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'created_at' => $_POST['created_at'] ?? '',
            ];
            $errors = $this->validarCredenciales($usuario['username'], $usuario['password']);
            if (empty($errors) && !empty($usuario['created_at']) && User::crear($usuario['username'], $usuario['password'], $usuario['created_at'])) {
                header("Location: index.php?url=admin/usuarios");
                exit;
            }
            $error = implode(" ", $errors ?: ["No fue posible registrar el usuario."]);
        }
        $desdeUsuarios = true;
        require_once __DIR__ . "/../views/admin/register.php";
    }

    public function editar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die("ID no encontrado.");
        $error = "";
        $usuario = User::obtenerPorId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = [
                'username' => trim($_POST['username'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'created_at' => $_POST['created_at'] ?? '',
            ];
            $errors = $this->validarCredenciales($usuario['username'], $usuario['password']);
            if (empty($errors) && !empty($usuario['created_at']) && User::actualizar($id, $usuario['username'], $usuario['password'], $usuario['created_at'])) {
                header("Location: index.php?url=admin/usuarios");
                exit;
            }
            $error = implode(" ", $errors ?: ["No fue posible actualizar el usuario."]);
        }
        require_once __DIR__ . "/../views/admin/usuariosform.php";
    }

    public function eliminar()
    {
        $this->verificarLogin();
        $id = $_GET['id'] ?? die("ID no encontrado.");
        User::eliminar($id);
        header("Location: index.php?url=admin/usuarios");
        exit;
    }

    public function registrarVenta()
    {
        $this->verificarLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = trim($_POST['cliente'] ?? '');
            $items = [];
            $productos = $_POST['producto_id'] ?? [];
            $cantidades = $_POST['cantidad'] ?? [];
            foreach ($productos as $index => $productId) {
                $cantidad = (int)($cantidades[$index] ?? 0);
                if ((int)$productId > 0 && $cantidad > 0) {
                    $items[] = ['id_producto' => (int)$productId, 'cantidad' => $cantidad];
                }
            }
            if ($cliente !== '' && mb_strlen($cliente) >= 3 && !empty($items)) {
                Venta::crearConDetalle($cliente, $items);
            }
            header("Location: index.php?url=admin/ventas");
            exit;
        }
        header("Location: index.php?url=admin/ventas");
        exit;
    }

    public function cerrarSesion()
    {
        $_SESSION = [];
        if (ini_get("session_use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        session_destroy();
        header("Location: index.php?url=catalogo");
        exit;
    }
}
?>
