CREATE DATABASE IF NOT EXISTS comerselec;
USE comerselec;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi') ON DUPLICATE KEY UPDATE id=id;

ALTER TABLE users ADD COLUMN IF NOT EXISTS role ENUM('Administrador', 'Compras', 'Ventas', 'Contabilidad') DEFAULT 'Administrador';

Actualizar el admin actual para que tenga el rol
UPDATE users SET role = 'Administrador' WHERE username = 'admin';


-- Tabla de categorías
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name, description) VALUES ('Cables', 'Cables eléctricos de diferentes calibres y tipos') ON DUPLICATE KEY UPDATE id=id;
INSERT INTO categories (name, description) VALUES ('Iluminación', 'Focos, lámparas y paneles LED') ON DUPLICATE KEY UPDATE id=id;
INSERT INTO categories (name, description) VALUES ('Herramientas', 'Herramientas manuales y eléctricas para electricistas') ON DUPLICATE KEY UPDATE id=id;


-- Tabla de productos  -- Producto eliminado para pasarlo al módulo Inventario
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

INSERT INTO products (category_id, name, description, price) VALUES (1, 'Cable THHN #12 AWG', 'Rollo de 100 metros color rojo', 45.50) ON DUPLICATE KEY UPDATE id=id;
INSERT INTO products (category_id, name, description, price) VALUES (2, 'Foco LED 9W', 'Foco LED luz blanca 6500K', 2.50) ON DUPLICATE KEY UPDATE id=id;

ALTER TABLE products ADD COLUMN IF NOT EXISTS image_url VARCHAR(255) DEFAULT NULL;

-- Actualizar todos los productos ingresados con una imagen genérica por categoría
-- Herramientas
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1581147036324-c104d49ad5f2?auto=format&fit=crop&q=80&w=400' WHERE category_id = 3;

-- Iluminación / Focos / Paneles
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=400' WHERE category_id = 2;

-- Cables u otras categorías por defecto
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=400' WHERE category_id NOT IN (2, 3);

ALTER TABLE products
ADD COLUMN id_marca INT NOT NULL AFTER category_id,
ADD COLUMN id_proveedor INT NOT NULL AFTER id_marca;

ALTER TABLE products
ADD CONSTRAINT fk_producto_marca
FOREIGN KEY (id_marca)
REFERENCES marcas(id_marca);

ALTER TABLE products
ADD CONSTRAINT fk_producto_proveedor
FOREIGN KEY (id_proveedor)
REFERENCES proveedores(id_proveedor);

ALTER TABLE products
ADD COLUMN id_marca INT NULL AFTER category_id,
ADD COLUMN id_proveedor INT NULL AFTER id_marca;

UPDATE products
SET id_marca = 1
WHERE id_marca IS NULL OR id_marca = 0;

UPDATE products
SET id_proveedor = 1
WHERE id_proveedor IS NULL OR id_proveedor = 0;

ALTER TABLE products
MODIFY id_marca INT NOT NULL,
MODIFY id_proveedor INT NOT NULL;

ALTER TABLE products
ADD CONSTRAINT fk_producto_marca
FOREIGN KEY (id_marca)
REFERENCES marcas(id_marca);

ALTER TABLE products
ADD CONSTRAINT fk_producto_proveedor
FOREIGN KEY (id_proveedor)
REFERENCES proveedores(id_proveedor);


-- Tabla de marcas
CREATE TABLE IF NOT EXISTS marcas (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    pais_origen VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO marcas(nombre, descripcion, pais_origen)
VALUES
('Schneider Electric','Equipos eléctricos','Francia'),
('Siemens','Automatización y energía','Alemania')
ON DUPLICATE KEY UPDATE nombre=nombre;


-- Tabla de proveedores
CREATE TABLE IF NOT EXISTS proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    direccion VARCHAR(200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO proveedores (nombre, telefono, correo, direccion) VALUES
('Electro Comercializadora S.A.', '0991234567', 'electrocomercial@gmail.com', 'Quito, Ecuador'),
('Importadora Eléctrica Ecuatoriana', '0987654321', 'importadoraelectrica@gmail.com', 'Quito, Ecuador'),
('Distribuidora de Material Eléctrico Nacional', '0976543210', 'dmenacional@gmail.com', 'Guayaquil, Ecuador'),
('Suministros Eléctricos Andinos', '0965432109', 'suministrosandinos@gmail.com', 'Quito, Ecuador'),
('Tecnología Eléctrica Industrial S.A.', '0954321098', 'info@tecelindustrial.com', 'Cuenca, Ecuador');


-- Tabla de inventario
CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `stock`, `created_at`) VALUES
(1, 1, 20, '2026-07-07 05:37:43'),
(2, 2, 150, '2026-07-07 05:37:43'),
(3, 3, 5, '2026-07-07 05:37:43'),
(4, 4, 5, '2026-07-07 05:37:43'),
(5, 6, 10, '2026-07-07 05:37:43');

ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `fk_inventario_producto` (`id_producto`);

ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

ALTER TABLE inventario
ADD ubicacion VARCHAR(100) NOT NULL DEFAULT 'Bodega Principal';

ALTER TABLE inventario
ADD UNIQUE (id_producto);

-- Tabla de mensajes de contacto
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Roberto', 'roberto@gmail.com', 'Tarea', 'Ya envié mi parte.', '2026-07-05 03:11:43'),
(2, 'LG_ 004', 'luisangell2099@gmail.com', 'Taller', 'Hola', '2026-07-06 03:59:18');