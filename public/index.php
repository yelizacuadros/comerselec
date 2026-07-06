<?php
require_once __DIR__ . "/../app/controllers/PublicController.php";
require_once __DIR__ . "/../app/controllers/UserController.php";
require_once __DIR__ . "/../app/controllers/ProductController.php";
require_once __DIR__ . "/../app/controllers/CategoryController.php";
require_once __DIR__ . "/../app/controllers/MessageController.php";

$url = $_GET['url'] ?? 'catalogo';

switch ($url) {

    // Rutas públicas
    case 'catalogo':
        $publicCtrl = new PublicController();
        $publicCtrl->catalogo();
        break;

    case 'nosotros':
        $publicCtrl = new PublicController();
        $publicCtrl->nosotros();
        break;

    case 'contacto':
        $publicCtrl = new PublicController();
        $publicCtrl->contacto();
        break;

    // Autenticación
    case 'admin/login':
        $userCtrl = new UserController();
        $userCtrl->iniciarSesion();
        break;

    case 'admin/registro':
        $userCtrl = new UserController();
        $userCtrl->registrar();
        break;

    case 'admin/salir':
        $userCtrl = new UserController();
        $userCtrl->cerrarSesion();
        break;

    case 'admin/panel':
        $userCtrl = new UserController();
        $userCtrl->panelPrincipal();
        break;

    // Mensajes
    case 'admin/mensajes':
        $messageCtrl = new MessageController();
        $messageCtrl->listar();
        break;

    // Categorías
    case 'admin/categorias':
        $categoryCtrl = new CategoryController();
        $categoryCtrl->listar();
        break;

    case 'admin/categorias_crear':
        $categoryCtrl = new CategoryController();
        $categoryCtrl->crear();
        break;

    case 'admin/categorias_editar':
        $categoryCtrl = new CategoryController();
        $categoryCtrl->editar();
        break;

    case 'admin/categorias_eliminar':
        $categoryCtrl = new CategoryController();
        $categoryCtrl->eliminar();
        break;

    // Productos
    case 'admin/productos':
        $productCtrl = new ProductController();
        $productCtrl->listar();
        break;

    case 'admin/productos_crear':
        $productCtrl = new ProductController();
        $productCtrl->crear();
        break;

    case 'admin/productos_editar':
        $productCtrl = new ProductController();
        $productCtrl->editar();
        break;

    case 'admin/productos_eliminar':
        $productCtrl = new ProductController();
        $productCtrl->eliminar();
        break;

    // Usuarios
    case 'admin/usuarios':
        $userCtrl = new UserController();
        $userCtrl->listar();
        break;

    case 'admin/usuarios_crear':
        $userCtrl = new UserController();
        $userCtrl->crear();
        break;

    case 'admin/usuarios_editar':
        $userCtrl = new UserController();
        $userCtrl->editar();
        break;

    case 'admin/usuarios_eliminar':
        $userCtrl = new UserController();
        $userCtrl->eliminar();
        break;

    // Error 404
    default:
        http_response_code(404);
        echo "<h1>404 - Ruta no encontrada</h1>";
        break;
}
?>