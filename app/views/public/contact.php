<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Contacto</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: #D0E3F0; border-radius: 2rem;">
    <header class="main-header">
        <div class="container header-container">
            <div class="logo">
                <h1>COMERSELEC S.A.</h1>
                <p>Materiales Eléctricos</p>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php?url=catalogo">CATÁLOGO</a></li>
                    <li><a href="index.php?url=nosotros">NOSOTROS</a></li>
                    <li><a href="index.php?url=contacto" class="active">CONTACTO</a></li>
                    <li><a href="index.php?url=admin/login" class="btn-login">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container" style="padding: 40px 0;">
        <div class="text-container" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; color: var(--primary-color);">Contáctanos</h2>
            <p style="text-align: center; color: #FF5A00; margin-bottom: 20px; font-weight: bold">Envía tu mensaje directamente a nuestro equipo de ventas</p> <br> 
            
            <?php if(isset($success) && $success): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($error) && $error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="index.php?url=contacto" method="POST" id="contactForm">
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name"  class="form-control" minlength="2" maxlength="100" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" id="email" name="email"  class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject">Asunto:</label>
                    <input type="text" id="subject" name="subject"  class="form-control" minlength="3" maxlength="150" value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje:</label>
                    <textarea id="message" name="message" rows="5"  class="form-control" minlength="10" maxlength="2000" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 50%; margin: auto; display: block;">Enviar</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> COMERSELEC S.A. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
