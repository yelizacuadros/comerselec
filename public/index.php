<?php
// Cambiar el directorio de trabajo al directorio raíz del proyecto
chdir(dirname(__DIR__));

// Ruteador simple
$action = isset($_GET['action']) ? $_GET['action'] : 'catalog';

$public_actions = ['catalog', 'about', 'contact'];

if(in_array($action, $public_actions)) {
    require_once 'app/controllers/PublicController.php';
    $controller = new PublicController();
    if($action == 'about') {
        $controller->about();
    } elseif($action == 'contact') {
        $controller->contact();
    } else {
        $controller->index();
    }
} else {
    require_once 'app/controllers/AdminController.php';
    $controller = new AdminController();
    $controller->handleRequest();
}
?>