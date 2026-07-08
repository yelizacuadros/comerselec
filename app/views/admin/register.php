<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario Usuario - COMERSELEC S.A.</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>
        <div class="admin-layout">

            <?php require_once __DIR__ . '/_sidebar.php'; ?>

            <main class="admin-content">

                <div class="admin-header">
                    <h1>Nuevo Usuario</h1>
                    <a href="index.php?url=admin/usuarios" class="btn btn-secondary">Volver</a>
                </div>

                <br>

                <div class="text-container" style="background:white; border-radius:8px; max-width:340px; min-height:390px; margin:0;">

                    <?php if(isset($error) && !empty($error)): ?>
                        <div style="background:#f8d7da;color:#721c24;padding:10px;margin-bottom:15px;">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($success) && !empty($success)): ?>
                        <div style="background:#d4edda;color:#155724;padding:10px;margin-bottom:15px;">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?url=admin/registro" method="POST" id="usuarioForm">

                        <div class="form-group">
                            <label>Usuario:</label>
                            <input type="text" name="username" class="form-control" minlength="3" maxlength="50" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" name="password" class="form-control" minlength="4" required>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-primary" style="margin:auto; display:block;">
                            Registrar Usuario
                        </button>
                    </form>
                </div>
            </main>
        </div>
        <script src="public/js/main.js"></script>
    </body>
</html>
