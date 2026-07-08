<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuarios - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?> 

        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($usuario['id']) ? 'Editar' : 'Nuevo'; ?> Usuario</h1>
                <a href="index.php?url=admin/usuarios" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 350px; height: 410px; margin: 0;">
                <form action="index.php?url=<?php echo isset($usuario['id']) ? 'admin/usuarios_editar&id='.$usuario['id'] : 'admin/usuarios_crear'; ?>" method="POST" id="usuarioForm">
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($usuario['username']) ? htmlspecialchars($usuario['username']) : ''; ?>" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Fecha de Creación:</label>
                        <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="<?php echo isset($usuario['created_at']) ? date('Y-m-d\TH:i', strtotime($usuario['created_at'])) : ''; ?>" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Usuario</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
