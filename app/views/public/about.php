<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Nosotros</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: #D0E3F0;">
    <header class="main-header">
        <div class="container header-container">
            <div class="logo">
                <h1>COMERSELEC S.A.</h1>
                <p>Materiales Eléctricos</p>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php?action=catalog">CATÁLOGO</a></li>
                    <li><a href="index.php?action=about" class="active">NOSOTROS</a></li>
                    <li><a href="index.php?action=contact">CONTACTO</a></li>
                    <li><a href="index.php?action=login" class="btn-login">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container" style="padding: 40px 0;">
        <div class="text-container" style="max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="color: var(--primary-color); text-align: center; margin-bottom: 30px;">Acerca de COMERSELEC S.A.</h2>
            
            <h3 style="color: var(--secondary-color); margin-top: 20px;">Nuestra Historia</h3>
            <p style="margin-bottom: 20px; line-height: 1.6;">Nuestra empresa cuenta con 15 años de trayectoria en el mercado, consolidándonos como proveedores de confianza para múltiples empresas constructoras, hospitales, fábricas y más. Nos enorgullece mantener un amplio stock permanente, garantizando entregas directas a obra y a cualquier rincón del país. Además, ofrecemos crédito directo y atención completamente personalizada para adaptarnos a las necesidades de cada proyecto.</p>

            <h3 style="color: var(--secondary-color); margin-top: 20px;">Misión</h3>
            <p style="margin-bottom: 20px; line-height: 1.6;">Proveer soluciones integrales en materiales eléctricos con agilidad, calidad y precios competitivos, acompañando a nuestros clientes con asesoría personalizada y opciones de financiamiento para asegurar el éxito y continuidad de sus obras.</p>

            <h3 style="color: var(--secondary-color); margin-top: 20px;">Visión</h3>
            <p style="margin-bottom: 20px; line-height: 1.6;">Consolidarnos como el aliado estratégico más importante a nivel nacional en el suministro de insumos eléctricos, reconocidos por nuestra eficiencia operativa, la robustez de nuestro inventario y la excelencia en el servicio al cliente.</p>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> COMERSELEC S.A. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
