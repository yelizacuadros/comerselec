<?php
require_once 'app/config/database.php';
require_once 'app/models/Category.php';
require_once 'app/models/Product.php';
require_once 'app/models/User.php';
require_once 'app/models/Message.php';

class AdminController {
    private $db;
    private $category;
    private $product;
    private $user;
    private $message;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
        $this->product = new Product($this->db);
        $this->user = new User($this->db);
        $this->message = new Message($this->db);
        
        session_start();
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
        
        // Excepciones para no estar logueado
        $public_actions = ['login', 'register'];
        if(!isset($_SESSION['user_id']) && !in_array($action, $public_actions)) {
            header("Location: index.php?action=login");
            exit();
        }

        switch($action) {
            case 'login':
                $this->login();
                break;
            case 'register':
                $this->register();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'dashboard':
                $this->dashboard();
                break;
            case 'categories':
                $this->categories();
                break;
            case 'categories_add':
                $this->categories_add();
                break;
            case 'categories_edit':
                $this->categories_edit();
                break;
            case 'categories_delete':
                $this->categories_delete();
                break;
            case 'products':
                $this->products();
                break;
            case 'products_add':
                $this->products_add();
                break;
            case 'products_edit':
                $this->products_edit();
                break;
            case 'products_delete':
                $this->products_delete();
                break;
            case 'messages':
                $this->messages();
                break;
            default:
                $this->dashboard();
                break;
        }
    }

    private function login() {
        $error = "";
        if($_POST) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];
            if($this->user->login()) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_role'] = $this->user->role;
                $_SESSION['username'] = $this->user->username;
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }
        require_once 'app/views/admin/login.php';
    }

    private function register() { //Evalua si el usuario ya existe
    $error = ""; 
    $success = "";

    if($_POST) {
        $this->user->username = $_POST['username'];
        $this->user->password = $_POST['password'];
        $this->user->role = $_POST['role'];

        $resultado = $this->user->register();

        if($resultado == "Usuario registrado correctamente") {
            $success = $resultado;
        } else {
            $error = $resultado;
        }
    }

    require_once 'app/views/admin/register.php';
}

    private function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    private function dashboard() {
        require_once 'app/views/admin/dashboard.php';
    }

    // --- MESSAGES (Contact) ---
    private function messages() {
        $stmt = $this->message->readAll();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/admin/messages.php';
    }

    // --- CATEGORIES CRUD ---
    private function categories() {
        $stmt = $this->category->readAll();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/admin/categories.php';
    }

    private function categories_add() {
        if($_POST) {
            $this->category->name = $_POST['name'];
            $this->category->description = $_POST['description'];
            if($this->category->create()) {
                header("Location: index.php?action=categories");
                exit();
            }
        }
        require_once 'app/views/admin/categories_form.php';
    }

    private function categories_edit() {
        $this->category->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        
        if($_POST) {
            $this->category->name = $_POST['name'];
            $this->category->description = $_POST['description'];
            if($this->category->update()) {
                header("Location: index.php?action=categories");
                exit();
            }
        } else {
            $this->category->readOne();
        }
        require_once 'app/views/admin/categories_form.php';
    }

    private function categories_delete() {
        $this->category->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        $this->category->delete();
        header("Location: index.php?action=categories");
        exit();
    }

    // --- PRODUCTS CRUD ---
    private function products() {
        $stmt = $this->product->readAll();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/admin/products.php';
    }

    private function products_add() {
        if($_POST) {
            $this->product->category_id = $_POST['category_id'];
            $this->product->name = $_POST['name'];
            $this->product->description = $_POST['description'];
            $this->product->price = $_POST['price'];
            $this->product->stock = $_POST['stock'];
            $this->product->image_url = $_POST['image_url'];
            
            if($this->product->create()) {
                header("Location: index.php?action=products");
                exit();
            }
        }
        $stmt_cat = $this->category->readAll();
        $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/admin/products_form.php';
    }

    private function products_edit() {
        $this->product->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        $this->product->readOne(); // Load current data
        $current_price = $this->product->price;

        if($_POST) {
            $this->product->category_id = $_POST['category_id'];
            $this->product->name = $_POST['name'];
            $this->product->description = $_POST['description'];
            $this->product->stock = $_POST['stock'];
            $this->product->image_url = $_POST['image_url'];
            
            // Restricción: Si es Ventas, no puede editar el precio (usamos el actual)
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Ventas') {
                $this->product->price = $current_price;
            } else {
                $this->product->price = $_POST['price'];
            }

            if($this->product->update()) {
                header("Location: index.php?action=products");
                exit();
            }
        }
        
        $stmt_cat = $this->category->readAll();
        $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/admin/products_form.php';
    }

    private function products_delete() {
        $this->product->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        $this->product->delete();
        header("Location: index.php?action=products");
        exit();
    }
}
?>