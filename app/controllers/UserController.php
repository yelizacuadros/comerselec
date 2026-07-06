<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Category.php";

class UserController
{
    //inicia la sesión si no está iniciada
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    //protege las ruta, redirigiendo al login si el usuario no ha iniciado sesión
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }
    //procesa el inicio de sesión del usuario, verificando las credenciales y estableciendo la sesión 
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
    //registrar un nuevo usuario, solo accesible para usuarios autenticados 
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
            if ($resultado === "ok") {
                $success = "Usuario registrado correctamente";
            } else {
                $error = $resultado;
            }
        }
        require_once __DIR__ . "/../views/admin/register.php";
    }
    //cierra la sesión del usuario y redirige a la página de inicio
   public function cerrarSesion()
    {
    // Limpiar todas las variables de sesión
        $_SESSION = [];

        // Destruir la sesión completamente
        if (ini_get("session_use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
    }
    session_destroy();

    // Redireccionar al catálogo limpio
    header("Location: index.php?url=catalogo");
    exit;
    }
    //muestra el panel principal del administrador
    public function panelPrincipal()
    {
        $this->verificarLogin();
        $products = Product::listar();
        $categories = Category::listar();
        require_once __DIR__ . "/../views/admin/dashboard.php";
    }
}
?>