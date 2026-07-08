<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Categoría - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($category['id']) ? 'Editar' : 'Nueva'; ?> Categoría</h1>
                <a href="index.php?url=admin/categorias" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <form action="index.php?url=<?php echo isset($category['id']) ? 'admin/categorias_editar&id='.$category['id'] : 'admin/categorias_crear'; ?>" method="POST" id="categoryForm">
                    <div class="form-group">
                        <label>Nombre de la Categoría:</label>
                        <input type="text" name="name" id="cat_name" class="form-control" maxlength="100" value="<?php echo isset($category['name']) ? htmlspecialchars($category['name']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <textarea name="description" class="form-control" rows="4" maxlength="255"><?php echo isset($category['description']) ? htmlspecialchars($category['description']) : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Categoría</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
