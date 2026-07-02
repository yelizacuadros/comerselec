CREATE DATABASE IF NOT EXISTS comerselec;
USE comerselec;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);


INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi') ON DUPLICATE KEY UPDATE id=id;


INSERT INTO categories (name, description) VALUES ('Cables', 'Cables eléctricos de diferentes calibres y tipos') ON DUPLICATE KEY UPDATE id=id;
INSERT INTO categories (name, description) VALUES ('Iluminación', 'Focos, lámparas y paneles LED') ON DUPLICATE KEY UPDATE id=id;
INSERT INTO categories (name, description) VALUES ('Herramientas', 'Herramientas manuales y eléctricas para electricistas') ON DUPLICATE KEY UPDATE id=id;


INSERT INTO products (category_id, name, description, price, stock) VALUES (1, 'Cable THHN #12 AWG', 'Rollo de 100 metros color rojo', 45.50, 20) ON DUPLICATE KEY UPDATE id=id;
INSERT INTO products (category_id, name, description, price, stock) VALUES (2, 'Foco LED 9W', 'Foco LED luz blanca 6500K', 2.50, 150) ON DUPLICATE KEY UPDATE id=id;
