<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image_url;
    public $category_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.stock, p.image_url, p.category_id, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByCategory() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.stock, p.image_url, p.category_id, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.category_id = ? 
                  ORDER BY p.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET category_id=:category_id, name=:name, description=:description, price=:price, stock=:stock, image_url=:image_url";
        $stmt = $this->conn->prepare($query);

        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));

        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":image_url", $this->image_url);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT category_id, name, description, price, stock, image_url FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->category_id = $row['category_id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->stock = $row['stock'];
            $this->image_url = $row['image_url'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET category_id = :category_id, name = :name, description = :description, price = :price, stock = :stock, image_url = :image_url WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>