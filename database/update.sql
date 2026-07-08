-- 1. Añadir rol a usuarios (si no existe)
ALTER TABLE users ADD COLUMN IF NOT EXISTS role ENUM('Administrador', 'Compras', 'Ventas', 'Contabilidad') DEFAULT 'Administrador';

-- Actualizar el admin actual para que tenga el rol
UPDATE users SET role = 'Administrador' WHERE username = 'admin';

-- 2. Crear tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(150),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Añadir columna de imagen a los productos
ALTER TABLE products ADD COLUMN IF NOT EXISTS image_url VARCHAR(255) DEFAULT NULL;

-- 4. Actualizar todos los productos ingresados con una imagen genérica por categoría
-- Herramientas
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1581147036324-c104d49ad5f2?auto=format&fit=crop&q=80&w=400' WHERE category_id = 3;

-- Iluminación / Focos / Paneles
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=400' WHERE category_id = 2;

-- Cables u otras categorías por defecto
UPDATE products SET image_url = 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=400' WHERE category_id NOT IN (2, 3);

-- 5. Crear tabla de ventas simples
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
('Ferreter�a San Jos�', '8 interruptores, 6 tomacorrientes', 74.25, '2026-07-07 09:45:00')
ON DUPLICATE KEY UPDATE cliente = cliente;


CREATE TABLE IF NOT EXISTS venta_detalle (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES products(id)
);


-- 6. Normalizar imágenes a URLs externas
UPDATE products
SET image_url = CASE
    WHEN LOWER(name) LIKE ''%cable%'' THEN ''https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=1200''
    WHEN LOWER(name) LIKE ''%foco%'' OR LOWER(name) LIKE ''%led%'' THEN ''https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=1200''
    WHEN LOWER(name) LIKE ''%breaker%'' OR LOWER(name) LIKE ''%interruptor%'' OR LOWER(name) LIKE ''%tablero%'' THEN ''https://images.unsplash.com/photo-1581147036324-c104d49ad5f2?auto=format&fit=crop&q=80&w=1200''
    ELSE ''https://images.unsplash.com/photo-1498050108023-6c1ef8f2f9b1?auto=format&fit=crop&q=80&w=1200''
END;