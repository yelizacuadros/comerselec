<?php
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/Message.php";

class PublicController
{
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

    public function nosotros()
    {
        require_once __DIR__ . "/../views/public/about.php";
    }

    public function noticias()
    {
        require_once __DIR__ . "/../views/public/news.php";
    }

    public function contacto()
    {
        $success = "";
        $error = "";
        $name = $email = $subject = $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? "");
            $email = trim($_POST['email'] ?? "");
            $subject = trim($_POST['subject'] ?? "");
            $message = trim($_POST['message'] ?? "");
            $errors = [];
            if ($name === '' || mb_strlen($name) < 2) $errors[] = "El nombre es obligatorio y debe tener al menos 2 caracteres.";
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "El correo debe tener un formato válido.";
            if ($subject === '' || mb_strlen($subject) < 3) $errors[] = "El asunto es obligatorio y debe tener al menos 3 caracteres.";
            if ($message === '' || mb_strlen($message) < 10) $errors[] = "El mensaje debe tener al menos 10 caracteres.";

            if (empty($errors) && Message::crear($name, $email, $subject, $message)) {
                $success = "¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.";
                $name = $email = $subject = $message = "";
            } else {
                $error = implode(" ", $errors ?: ["Hubo un error al enviar el mensaje. Inténtalo de nuevo."]);
            }
        }
        require_once __DIR__ . "/../views/public/contact.php";
    }
}
?>
