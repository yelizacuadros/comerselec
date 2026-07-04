<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="admin-body" style="background-color: #D0E3F0;">
    <div class="login-container">
        <h2 style="text-align: center; color: var(--primary-color); color: #0A192F; font-size: 25px;">Registro de Usuario</h2> 
        <br>
        <?php if(isset($error) && !empty($error)): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; text-align: center; margin-bottom: 15px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($success) && !empty($success)): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; text-align: center; margin-bottom: 15px;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=register" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Rol:</label>
                <select id="role" name="role" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Administrador">Administrador</option>
                    <option value="Compras">Compras</option>
                    <option value="Ventas">Ventas</option>
                    <option value="Contabilidad">Contabilidad</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"; style="width: 100%;">Registrar</button>
            
            <div class="form-group" style="text-align: center; margin-top: 15px;">
                <a href="index.php?action=login" style="margin-right: 15px;">Ya tengo cuenta (Iniciar Sesión)</a><br>
                <a href="index.php?action=catalog">Volver al catálogo</a>
            </div>
        </form>
    </div>
</body>
</html>
