<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
header('Content-Type: text/html; charset=UTF-8');

set_exception_handler(function (Throwable $e) {
    error_log((string) $e);
    http_response_code(500);
    echo 'Error interno del servidor.';
});

spl_autoload_register(function ($class) {
    $controllerPath = __DIR__ . '/../app/controllers/' . $class . '.php';
    $modelPath = __DIR__ . '/../app/models/' . $class . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        return;
    }

    if (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

$url = $_GET['url'] ?? 'catalogo';

switch ($url) {
    case 'catalogo':
        require_once __DIR__ . '/../app/controllers/PublicController.php';
        (new PublicController())->catalogo();
        break;

    case 'nosotros':
        require_once __DIR__ . '/../app/controllers/PublicController.php';
        (new PublicController())->nosotros();
        break;

    case 'noticias':
        require_once __DIR__ . '/../app/controllers/PublicController.php';
        (new PublicController())->noticias();
        break;

    case 'contacto':
        require_once __DIR__ . '/../app/controllers/PublicController.php';
        (new PublicController())->contacto();
        break;

    case 'admin/login':
    case 'admin/registro':
    case 'admin/salir':
    case 'admin/panel':
    case 'admin/usuarios':
    case 'admin/usuarios_crear':
    case 'admin/usuarios_editar':
    case 'admin/usuarios_eliminar':
        require_once __DIR__ . '/../app/controllers/UserController.php';
        $userCtrl = new UserController();
        if ($url === 'admin/login') $userCtrl->iniciarSesion();
        elseif ($url === 'admin/registro') $userCtrl->registrar();
        elseif ($url === 'admin/salir') $userCtrl->cerrarSesion();
        elseif ($url === 'admin/panel') $userCtrl->panelPrincipal();
        elseif ($url === 'admin/usuarios') $userCtrl->listar();
        elseif ($url === 'admin/usuarios_crear') $userCtrl->crear();
        elseif ($url === 'admin/usuarios_editar') $userCtrl->editar();
        elseif ($url === 'admin/usuarios_eliminar') $userCtrl->eliminar();
        break;

    case 'admin/mensajes':
        require_once __DIR__ . '/../app/controllers/MessageController.php';
        (new MessageController())->listar();
        break;

    case 'admin/categorias':
    case 'admin/categorias_crear':
    case 'admin/categorias_editar':
    case 'admin/categorias_eliminar':
        require_once __DIR__ . '/../app/controllers/CategoryController.php';
        $categoryCtrl = new CategoryController();
        if ($url === 'admin/categorias') $categoryCtrl->listar();
        elseif ($url === 'admin/categorias_crear') $categoryCtrl->crear();
        elseif ($url === 'admin/categorias_editar') $categoryCtrl->editar();
        elseif ($url === 'admin/categorias_eliminar') $categoryCtrl->eliminar();
        break;

    case 'admin/marcas':
    case 'admin/marcas_crear':
    case 'admin/marcas_editar':
    case 'admin/marcas_eliminar':
        require_once __DIR__ . '/../app/controllers/MarcaController.php';
        $marcaCtrl = new MarcaController();
        if ($url === 'admin/marcas') $marcaCtrl->listar();
        elseif ($url === 'admin/marcas_crear') $marcaCtrl->crear();
        elseif ($url === 'admin/marcas_editar') $marcaCtrl->editar();
        elseif ($url === 'admin/marcas_eliminar') $marcaCtrl->eliminar();
        break;

    case 'admin/proveedores':
    case 'admin/proveedores_crear':
    case 'admin/proveedores_editar':
    case 'admin/proveedores_eliminar':
        require_once __DIR__ . '/../app/controllers/ProveedorController.php';
        $proveedorCtrl = new ProveedorController();
        if ($url === 'admin/proveedores') $proveedorCtrl->listar();
        elseif ($url === 'admin/proveedores_crear') $proveedorCtrl->crear();
        elseif ($url === 'admin/proveedores_editar') $proveedorCtrl->editar();
        elseif ($url === 'admin/proveedores_eliminar') $proveedorCtrl->eliminar();
        break;

    case 'admin/productos':
    case 'admin/productos_crear':
    case 'admin/productos_editar':
    case 'admin/productos_eliminar':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $productCtrl = new ProductController();
        if ($url === 'admin/productos') $productCtrl->listar();
        elseif ($url === 'admin/productos_crear') $productCtrl->crear();
        elseif ($url === 'admin/productos_editar') $productCtrl->editar();
        elseif ($url === 'admin/productos_eliminar') $productCtrl->eliminar();
        break;

    case 'admin/inventario':
    case 'admin/inventario_crear':
    case 'admin/inventario_editar':
    case 'admin/inventario_eliminar':
        require_once __DIR__ . '/../app/controllers/InventarioController.php';
        $inventarioCtrl = new InventarioController();
        if ($url === 'admin/inventario') $inventarioCtrl->listar();
        elseif ($url === 'admin/inventario_crear') $inventarioCtrl->crear();
        elseif ($url === 'admin/inventario_editar') $inventarioCtrl->editar();
        elseif ($url === 'admin/inventario_eliminar') $inventarioCtrl->eliminar();
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Ruta no encontrada</h1>';
        break;
}
