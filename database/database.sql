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
    id_marca INT NOT NULL,
    id_proveedor INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (id_marca) REFERENCES marcas(id_marca),
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor)
);

CREATE TABLE IF NOT EXISTS inventario (
    id_inventario INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL UNIQUE,
    stock INT NOT NULL DEFAULT 0,
    ubicacion VARCHAR(100) NOT NULL DEFAULT 'Bodega Principal',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(150),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE username = username;

INSERT INTO categories (name, description)
VALUES
('Cables', 'Cables eléctricos de diferentes calibres y tipos'),
('Iluminación', 'Focos, lámparas y paneles LED'),
('Herramientas', 'Herramientas manuales y eléctricas para electricistas')
ON DUPLICATE KEY UPDATE name = name;

INSERT INTO marcas (nombre, descripcion, pais_origen)
VALUES
('Schneider Electric', 'Equipos eléctricos', 'Francia'),
('Siemens', 'Automatización y energía', 'Alemania')
ON DUPLICATE KEY UPDATE nombre = nombre;

INSERT INTO proveedores (nombre, telefono, correo, direccion)
VALUES
('Electro Comercializadora S.A.', '0991234567', 'electrocomercial@gmail.com', 'Quito, Ecuador'),
('Importadora Eléctrica Ecuatoriana', '0987654321', 'importadoraelectrica@gmail.com', 'Quito, Ecuador'),
('Distribuidora de Material Eléctrico Nacional', '0976543210', 'dmenacional@gmail.com', 'Guayaquil, Ecuador'),
('Suministros Eléctricos Andinos', '0965432109', 'suministrosandinos@gmail.com', 'Quito, Ecuador'),
('Tecnología Eléctrica Industrial S.A.', '0954321098', 'info@tecelindustrial.com', 'Cuenca, Ecuador')
ON DUPLICATE KEY UPDATE nombre = nombre;

INSERT INTO products (category_id, id_marca, id_proveedor, name, description, price, image_url)
VALUES
(1, 1, 1, 'Cable THHN #12 AWG', 'Rollo de 100 metros color rojo', 45.50, NULL),
(2, 2, 2, 'Foco LED 9W', 'Foco LED luz blanca 6500K', 2.50, NULL)
ON DUPLICATE KEY UPDATE name = name;

INSERT INTO inventario (id_producto, stock, ubicacion)
VALUES
(1, 20, 'Bodega Principal'),
(2, 150, 'Bodega Principal')
ON DUPLICATE KEY UPDATE id_producto = id_producto;

INSERT INTO messages (name, email, subject, message, created_at)
VALUES
('Roberto', 'roberto@gmail.com', 'Tarea', 'Ya envié mi parte.', '2026-07-05 03:11:43'),
('LG_004', 'luisangell2099@gmail.com', 'Taller', 'Hola', '2026-07-06 03:59:18');

CREATE TABLE IF NOT EXISTS ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(150) NOT NULL,
    detalle TEXT NOT NULL,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO ventas (cliente, detalle, total, fecha_venta)
VALUES
('Constructora Quito S.A.', '12 focos LED, 3 breakers, 1 tablero', 185.40, '2026-07-05 10:15:00'),
('Carlos Mendoza', '2 rollos de cable THHN #12 AWG', 91.00, '2026-07-06 14:30:00'),
('Ferretería San José', '8 interruptores, 6 tomacorrientes', 74.25, '2026-07-07 09:45:00');

