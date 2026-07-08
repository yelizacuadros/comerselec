<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Marca - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>

        <main class="admin-content">
            <div class="admin-header">
                <h1>
                    <?php echo isset($marca['id_marca']) ? 'Editar' : 'Nueva'; ?> Marca
                </h1>
                <a href="index.php?url=admin/marcas" class="btn btn-secondary">
                    Volver
                </a>
            </div>

            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <!-- muestra un mensaje de error generado en el controlador si es que existe, de lo contrario no se muestra nada -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <form 
                    action="index.php?url=<?php echo isset($marca['id_marca']) ? 'admin/marcas_editar&id='.$marca['id_marca'] : 'admin/marcas_crear'; ?>" 
                    method="POST" 
                    id="marcaForm">

                    <div class="form-group">
                        <label>Nombre de la Marca:</label>

                        <input 
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control"
                            maxlength="100"
                            value="<?php echo isset($marca['nombre']) ? htmlspecialchars($marca['nombre']) : ''; ?>"
                            required>
                    </div>


                    <div class="form-group">
                        <label>Descripción:</label>

                        <textarea 
                            id="descripcion"
                            name="descripcion"
                            class="form-control"
                            rows="4"
                            maxlength="255"
                            required><?php echo isset($marca['descripcion']) ? htmlspecialchars($marca['descripcion']) : ''; ?></textarea>

                    </div>


                    <div class="form-group">
                        <label>País de origen:</label>

                        <input 
                            type="text"
                            id="pais_origen"
                            name="pais_origen"
                            class="form-control"
                            maxlength="50"
                            value="<?php echo isset($marca['pais_origen']) ? htmlspecialchars($marca['pais_origen']) : ''; ?>"
                            required>

                    </div>

                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">
                        Guardar Marca
                    </button>
                </form>
            </div>
        </main>

    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
