<?php
require_once __DIR__ . "/../models/Message.php";

class MessageController
{
    // Constructor que inicia la sesión si no está iniciada
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
    }
    //protege las rutas, redirigiendo al login si el usuario no ha iniciado sesión
    private function verificarLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=admin/login");
            exit;
        }
    }
    //lista todos los mensajes y los muestra en el panel de administración
    public function listar()
    {
        $this->verificarLogin();
        $messages = Message::listar();
        require_once __DIR__ . "/../views/admin/messages.php";
    }
}
?>