<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: #D0E3F0;">
    <div class="login-container">
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="color: #0A192F;">COMERSELEC S.A.</h1>
            <p style="color: #FF5A00;">Acceso Administrativo</p>
        </div>
        
        <?php if(!empty($error)): ?>
            <div style="color: red; margin-bottom: 15px; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php?url=admin/login" method="POST" id="loginForm">
            <div class="form-group">
                <label>Usuario:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Ingresar</button>
            <div class="form-group" style="text-align: center; margin-top: 15px;">
                <a href="index.php?url=admin/registro" style="margin-right: 15px;">Registrarse</a>
                <a href="index.php?url=catalogo">Volver al catálogo</a>
            </div>
        </form>
    </div>
    <script src="js/main.js"></script>
</body>
</html>