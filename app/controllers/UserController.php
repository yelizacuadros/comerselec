<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Category.php";

class UserController
{
    // Inicia la sesión si no está iniciada
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Protege las rutas
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }

    // Login
    public function iniciarSesion()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";

            $user = User::login($username, $password);

            if ($user) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['username'] = $user['username'];

                header("Location: index.php?url=admin/panel");
                exit;

            } else {

                $error = "Usuario o contraseña incorrectos.";

            }
        }

        require_once __DIR__ . "/../views/admin/login.php";
    }

    // Registro desde login
    public function registrar()
    {
        $this->verificarLogin();

        $error = "";
        $success = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";
            $role = $_POST['role'] ?? "";

            $resultado = User::registrar($username, $password, $role);

            if ($resultado == "ok") {

                $success = "Usuario registrado correctamente.";

            } else {

                $error = $resultado;

            }
        }

        require_once __DIR__ . "/../views/admin/register.php";
    }

    // Panel
    public function panelPrincipal()
    {
        $this->verificarLogin();

        $products = Product::listar();
        $categories = Category::listar();

        require_once __DIR__ . "/../views/admin/dashboard.php";
    }

    // CRUD Usuarios
    public function listar()
    {
        $this->verificarLogin();

        $usuarios = User::listar();

        require_once __DIR__ . "/../views/admin/usuarios.php";
    }

    public function crear()
    {
        $this->verificarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";
            $created_at = $_POST['created_at'] ?? "";
            $role = $_POST['role'] ?? "";

            if (User::crear($username, $password, $created_at, $role)) {

                header("Location: index.php?url=admin/usuarios");
                exit;

            } else {

                $error = "No fue posible registrar el usuario.";

            }
        }

        $desdeUsuarios = true;

        require_once __DIR__ . "/../views/admin/register.php";
    }

    public function editar()
    {
        $this->verificarLogin();

        $id = $_GET['id'] ?? die("ID no encontrado.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";
            $created_at = $_POST['created_at'] ?? "";
            $role = $_POST['role'] ?? "";

            if (User::actualizar($id, $username, $password, $created_at, $role)) {

                header("Location: index.php?url=admin/usuarios");
                exit;

            }

        } else {

            $usuario = User::obtenerPorId($id);

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

    // Cerrar sesión
    public function cerrarSesion()
    {
        $_SESSION = [];

        if (ini_get("session_use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: index.php?url=catalogo");
        exit;
    }
}