<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Nosotros</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="about-body">
    <header class="main-header">
        <div class="container header-container">
            <div class="logo">
                <h1>COMERSELEC S.A.</h1>
                <p>Materiales Eléctricos</p>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php?url=catalogo">CATÁLOGO</a></li>
                    <li><a href="index.php?url=nosotros" class="active">NOSOTROS</a></li>
                    <li><a href="index.php?url=noticias">NOTICIAS</a></li>
                    <li><a href="index.php?url=contacto">CONTACTO</a></li>
                    <li><a href="index.php?url=admin/login" class="btn-login">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Sección: Nuestra Historia con imagen al lado -->
    <section class="about-historia-section">
        <div class="about-historia-text">
            <h2 class="about-section-title">NUESTRA HISTORIA</h2>
            <p>Desde nuestros inicios hace más de 15 años, nos hemos dedicado a ser el proveedor de confianza en Ecuador de materiales eléctricos, iluminación, ferretería, gasfitería y automatización. A lo largo de estas décadas, hemos crecido y evolucionado con el mercado, pero siempre manteniendo nuestro compromiso con la calidad, el servicio y la satisfacción de nuestros clientes.</p>
            <p>Nuestra historia comenzó con una visión clara: ofrecer productos y soluciones de alta calidad que no solo cumplieran con las necesidades de nuestros clientes, sino que las superaran. Desde entonces, nos hemos consolidado como una empresa confiable, con una profunda comprensión de las necesidades del mercado en la industria, empresas y hogares en Ecuador.</p>
        </div>
        <div class="about-historia-img">
            <img src="nosotros_historia.png" alt="Bodega COMERSELEC S.A. con materiales eléctricos">
        </div>
    </section>

    <!-- Misión y Visión -->
    <section class="about-mv-section">
        <div class="container">
            <div class="about-mv-grid">
                <div class="about-mv-card">
                    <div class="about-mv-icon">🎯</div>
                    <h3>Misión</h3>
                    <p>Proveer soluciones integrales en materiales eléctricos con agilidad, calidad y precios competitivos, acompañando a nuestros clientes con asesoría personalizada y opciones de financiamiento para asegurar el éxito y continuidad de sus obras.</p>
                </div>
                <div class="about-mv-card">
                    <div class="about-mv-icon">🚀</div>
                    <h3>Visión</h3>
                    <p>Consolidarnos como el aliado estratégico más importante a nivel nacional en el suministro de insumos eléctricos, reconocidos por nuestra eficiencia operativa, la robustez de nuestro inventario y la excelencia en el servicio al cliente.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Valores -->
    <section class="about-values-section">
        <div class="container">
            <h2 class="about-values-title">NUESTROS VALORES</h2>
            <div class="about-values-grid">
                <div class="about-value-item">
                    <span class="about-value-icon">⚡</span>
                    <h4>Calidad</h4>
                    <p>Trabajamos solo con productos certificados y marcas de reconocida trayectoria en el mercado eléctrico.</p>
                </div>
                <div class="about-value-item">
                    <span class="about-value-icon">🤝</span>
                    <h4>Compromiso</h4>
                    <p>Nos comprometemos con cada cliente para cumplir los plazos de entrega y superar sus expectativas.</p>
                </div>
                <div class="about-value-item">
                    <span class="about-value-icon">🛡️</span>
                    <h4>Confianza</h4>
                    <p>15 años de trayectoria respaldan nuestra reputación como proveedor confiable en Ecuador.</p>
                </div>
                <div class="about-value-item">
                    <span class="about-value-icon">💡</span>
                    <h4>Innovación</h4>
                    <p>Incorporamos constantemente nuevas tecnologías y productos para mantenernos a la vanguardia del sector.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> COMERSELEC S.A. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>