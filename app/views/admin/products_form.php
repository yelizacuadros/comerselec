<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Producto - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC Admin</h2>
            <ul class="admin-nav">
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=categories">Gestión Categorías</a></li>
                <li><a href="index.php?action=products" style="background-color: rgba(255,255,255,0.1); color: white;">Gestión Productos</a></li>
                <li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li>
                <?php if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['Administrador', 'Ventas'])): ?>
                <li><a href="index.php?action=messages">Ver Mensajes</a></li>
                <?php endif; ?>
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($this->product->id) ? 'Editar' : 'Nuevo'; ?> Producto</h1>
                <a href="index.php?action=products" class="btn btn-secondary">Volver</a>
            </div>
            
            <div style="background: white; padding: 20px; border-radius: 8px; max-width: 600px;">
                <form action="index.php?action=<?php echo isset($this->product->id) ? 'products_edit&id='.$this->product->id : 'products_add'; ?>" method="POST" id="productForm">
                    
                    <div class="form-group">
                        <label>Categoría</label>
                        <select name="category_id" id="prod_category" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?php echo $c['id']; ?>" <?php echo (isset($this->product->category_id) && $this->product->category_id == $c['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($c['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Producto</label>
                        <input type="text" name="name" id="prod_name" class="form-control" value="<?php echo isset($this->product->name) ? htmlspecialchars($this->product->name) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo isset($this->product->description) ? htmlspecialchars($this->product->description) : ''; ?></textarea>
                    </div>

                    <div class="form-group" style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <label>Precio ($) <?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Ventas') ? '<small style="color:red;">(Solo lectura)</small>' : ''; ?></label>
                            <input type="number" step="0.01" min="0" name="price" id="prod_price" class="form-control" value="<?php echo isset($this->product->price) ? $this->product->price : ''; ?>" <?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Ventas') ? 'readonly' : 'required'; ?>>
                        </div>
                        <div style="flex: 1;">
                            <label>Stock</label>
                            <input type="number" min="0" name="stock" id="prod_stock" class="form-control" value="<?php echo isset($this->product->stock) ? $this->product->stock : '0'; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL de la Imagen (Opcional)</label>
                        <input type="url" name="image_url" class="form-control" value="<?php echo isset($this->product->image_url) ? htmlspecialchars($this->product->image_url) : ''; ?>" placeholder="https://ejemplo.com/imagen.jpg">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </form>
            </div>
        </main>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
