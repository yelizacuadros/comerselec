<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Proveedor - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="admin-layout">
    <?php require_once __DIR__ . '/_sidebar.php'; ?>



    <main class="admin-content">
        <div class="admin-header">
            <h1>
                <?php echo isset($proveedor['id_proveedor']) ? 'Editar' : 'Nuevo'; ?> Proveedor
            </h1>
            <a href="index.php?url=admin/proveedores" class="btn btn-secondary">
                Volver
            </a>
        </div>
        <br>
        <div class="text-container" style="background:white; border-radius:8px; max-width:450px; margin:0;">
            <!-- Verifica si existe un error enviado por el controlador y lo muestra al usuario -->
            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>
            <form 
                action="index.php?url=<?php echo isset($proveedor['id_proveedor']) 
                ? 'admin/proveedores_editar&id='.$proveedor['id_proveedor'] 
                : 'admin/proveedores_crear'; ?>" 
                method="POST" 
                id="proveedorForm">
                <div class="form-group">
                    <label>
                        Nombre del Proveedor:
                    </label>
                    <input 
                        type="text"
                        id="nombre_proveedor"
                        name="nombre"
                        class="form-control"
                        maxlength="100"
                        value="<?php echo isset($proveedor['nombre']) 
                        ? htmlspecialchars($proveedor['nombre']) 
                        : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>
                        Teléfono:
                    </label>
                    <input 
                        type="text"
                        id="telefono_proveedor"
                        name="telefono"
                        class="form-control"
                        maxlength="15"
                        value="<?php echo isset($proveedor['telefono']) 
                        ? htmlspecialchars($proveedor['telefono']) 
                        : ''; ?>"
                        required>
                </div>


                <div class="form-group">
                    <label>
                        Correo:
                    </label>
                    <input 
                        type="email"
                        id="correo_proveedor"
                        name="correo"
                        class="form-control"
                        value="<?php echo isset($proveedor['correo']) 
                        ? htmlspecialchars($proveedor['correo']) 
                        : ''; ?>"
                        required>
                </div>


                <div class="form-group">
                    <label>
                        Dirección:
                    </label>
                    <textarea
                        id="direccion_proveedor"
                        name="direccion"
                        class="form-control"
                        rows="4"
                        maxlength="255"
                        required><?php echo isset($proveedor['direccion']) 
                        ? htmlspecialchars($proveedor['direccion']) 
                        : ''; ?></textarea>
                </div>
                <button 
                    type="submit" 
                    class="btn btn-primary" 
                    style="margin:auto; display:block;">

                    Guardar Proveedor
                </button>
            </form>
        </div>
    </main>
</div>
<script src="public/js/main.js"></script>
</body>
</html>
