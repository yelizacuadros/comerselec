<?php
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Message.php";

class PublicController
{
    //muestra el catálogo de productos, filtrando por categoría si se proporciona un ID de categoría
    public function catalogo()
    {
        $categories = Category::listar();

        $keyword = trim($_GET['q'] ?? '');
        $category_id = $_GET['cat'] ?? null;

        if ($keyword !== '') {
            $products = Product::buscarPorPalabra($keyword);
        } elseif ($category_id) {
            $products = Product::listarPorCategoria($category_id);
        } else {
            $products = Product::listar();
        }

        require_once __DIR__ . "/../views/public/home.php";
    }
    //muestra la página de información "Nosotros"
    public function nosotros()
    {
        require_once __DIR__ . "/../views/public/about.php";
    }
    //muestra la página de noticias eléctricas
    public function noticias()
    {
        require_once __DIR__ . "/../views/public/news.php";
    }
    //muestra el formulario de contacto, guardando el mensaje en la base de datos y mostrando un mensaje de éxito o error 
    public function contacto()
    {
        $success = "";
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? "";
            $email = $_POST['email'] ?? "";
            $subject = $_POST['subject'] ?? "";
            $message = $_POST['message'] ?? "";

            if (Message::crear($name, $email, $subject, $message)) {
                $success = "¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.";
            } else {
                $error = "Hubo un error al enviar el mensaje. Inténtalo de nuevo.";
            }
        }

        require_once __DIR__ . "/../views/public/contact.php";
    }
}
?>