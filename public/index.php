<?php
require_once __DIR__ . "/../app/controllers/PublicController.php";
require_once __DIR__ . "/../app/controllers/UserController.php";
require_once __DIR__ . "/../app/controllers/ProductController.php";
require_once __DIR__ . "/../app/controllers/CategoryController.php";
require_once __DIR__ . "/../app/controllers/MessageController.php";


$url = $_GET['url'] ?? 'catalogo';

switch ($url) {
    // rutas públicas del sitio web
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

    // autenticación de usuarios
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

    // gestion de mensajes de contacto
    case 'admin/mensajes':
        $messageCtrl = new MessageController();
        $messageCtrl->listar();
        break;

    // Crud de categorias
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

    //crud de productos
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

    //ruta no encontrada -  ERROR 404
    default:
        http_response_code(404);
        echo "<h1>404 - Ruta no encontrada</h1>";
        break;
}
?>