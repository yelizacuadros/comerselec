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
