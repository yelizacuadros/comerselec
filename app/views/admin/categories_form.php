<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Categoría - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2 >COMERSELEC <span style="font-size: 16px; font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=categories" style="background-color: rgba(255,255,255,0.1); color: white;">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=messages">Mensajes</a></li>
                <li><a href="index.php?action=messages">Facturación</a></li> <!--Corregir link-->
                <!--li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li-->
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($this->category->id) ? 'Editar' : 'Nueva'; ?> Categoría</h1>
                <a href="index.php?action=categories" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <form action="index.php?action=<?php echo isset($this->category->id) ? 'categories_edit&id='.$this->category->id : 'categories_add'; ?>" method="POST" id="categoryForm">
                    <div class="form-group">
                        <label>Nombre de la Categoría:</label>
                        <input type="text" name="name" id="cat_name" class="form-control" value="<?php echo isset($this->category->name) ? htmlspecialchars($this->category->name) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo isset($this->category->description) ? htmlspecialchars($this->category->description) : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"; style= "margin: auto; display: block;">Guardar Categoría</button>
                </form>
            </div>
        </main>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
