<?php
require_once 'app/config/database.php';
require_once 'app/models/Category.php';
require_once 'app/models/Product.php';
require_once 'app/models/Message.php';

class PublicController {
    private $db;
    private $category;
    private $product;
    private $message;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
        $this->product = new Product($this->db);
        $this->message = new Message($this->db);
    }

    public function index() {
        $stmt_cat = $this->category->readAll();
        $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

        $category_id = isset($_GET['cat']) ? $_GET['cat'] : null;
        
        if($category_id) {
            $this->product->category_id = $category_id;
            $stmt_prod = $this->product->readByCategory();
        } else {
            $stmt_prod = $this->product->readAll();
        }
        $products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);

        require_once 'app/views/public/home.php';
    }

    public function about() {
        require_once 'app/views/public/about.php';
    }

    public function contact() {
        $success = "";
        $error = "";

        if($_POST) {
            $this->message->name = $_POST['name'];
            $this->message->email = $_POST['email'];
            $this->message->subject = $_POST['subject'];
            $this->message->message = $_POST['message'];

            if($this->message->create()) {
                $success = "¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.";
            } else {
                $error = "Hubo un error al enviar el mensaje. Inténtalo de nuevo.";
            }
        }

        require_once 'app/views/public/contact.php';
    }
}
?>