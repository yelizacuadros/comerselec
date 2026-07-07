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
CREATE TABLE IF NOT EXISTS marcas (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    pais_origen VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    direccion VARCHAR(200) NOT NULL,
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


INSERT INTO marcas(nombre, descripcion, pais_origen)
VALUES
('Schneider Electric','Equipos eléctricos','Francia'),
('Siemens','Automatización y energía','Alemania')
ON DUPLICATE KEY UPDATE nombre=nombre;


INSERT INTO proveedores (nombre, telefono, correo, direccion) VALUES
('Electro Comercializadora S.A.', '0991234567', 'electrocomercial@gmail.com', 'Quito, Ecuador'),
('Importadora Eléctrica Ecuatoriana', '0987654321', 'importadoraelectrica@gmail.com', 'Quito, Ecuador'),
('Distribuidora de Material Eléctrico Nacional', '0976543210', 'dmenacional@gmail.com', 'Guayaquil, Ecuador'),
('Suministros Eléctricos Andinos', '0965432109', 'suministrosandinos@gmail.com', 'Quito, Ecuador'),
('Tecnología Eléctrica Industrial S.A.', '0954321098', 'info@tecelindustrial.com', 'Cuenca, Ecuador');
 
INSERT INTO products (category_id, name, description, price, stock) VALUES (1, 'Cable THHN #12 AWG', 'Rollo de 100 metros color rojo', 45.50, 20) ON DUPLICATE KEY UPDATE id=id;
INSERT INTO products (category_id, name, description, price, stock) VALUES (2, 'Foco LED 9W', 'Foco LED luz blanca 6500K', 2.50, 150) ON DUPLICATE KEY UPDATE id=id;

