<?php
// Para cambiar el directorio de trabajo al directorio raíz 
chdir(dirname(__DIR__));

// Ruteador simple
$action = isset($_GET['action']) ? $_GET['action'] : 'catalog';

if($action == 'catalog') {
    require_once 'app/controllers/PublicController.php';
    $controller = new PublicController();
    $controller->index();
} else {
    require_once 'app/controllers/AdminController.php';
    $controller = new AdminController();
    $controller->handleRequest();
}
?>
