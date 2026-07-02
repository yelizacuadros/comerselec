<?php
require_once 'app/config/database.php';
require_once 'app/models/Category.php';
require_once 'app/models/Product.php';

class PublicController {
    private $db;
    private $category;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
        $this->product = new Product($this->db);
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

        // Cargar la vista principal
        require_once 'app/views/public/home.php';
    }
}
?>
