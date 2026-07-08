<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Noticias Eléctricas</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="news-body">
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
                    <li><a href="index.php?url=noticias" class="active">NOTICIAS</a></li>
                    <li><a href="index.php?url=contacto">CONTACTO</a></li>
                    <li><a href="index.php?url=admin/login" class="btn-login">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="news-hero">
        <div class="container">
            <h2>NOTICIAS DEL SECTOR ELÉCTRICO</h2>
            <p>Mantente informado con tendencias, innovaciones y normativas del mundo eléctrico.</p>
        </div>
    </div>

    <main class="container news-main">
        <div class="news-featured">
            <div class="news-featured-badge">⚡ DESTACADO</div>
            <div class="news-featured-content">
                <div class="news-featured-text">
                    <span class="news-tag news-tag-led">Iluminación LED</span>
                    <h3>Ecuador avanza hacia la iluminación LED eficiente</h3>
                    <p>El reemplazo de luminarias convencionales por tecnología LED permite reducir el consumo energético y los costos de mantenimiento en edificios públicos y privados.</p>
                    <div class="news-meta">
                        <span class="news-date">📅 Junio 2025</span>
                        <span class="news-source">Fuente: Sector Energético</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="news-grid">
            <article class="news-card">
                <div class="news-card-header news-card-header-cables">
                    <span class="news-card-emoji">🔌</span>
                </div>
                <div class="news-card-body">
                    <span class="news-tag news-tag-cables">Cables y Conductores</span>
                    <h4>Nuevas normas para cables de baja tensión</h4>
                    <p>Actualizaciones en estándares eléctricos exigen mayor resistencia al fuego y mejor aislamiento para instalaciones industriales.</p>
                </div>
            </article>

            <article class="news-card">
                <div class="news-card-header news-card-header-solar">
                    <span class="news-card-emoji">☀️</span>
                </div>
                <div class="news-card-body">
                    <span class="news-tag news-tag-solar">Energía Solar</span>
                    <h4>Créditos para paneles solares en hogares</h4>
                    <p>Se amplían las opciones de financiamiento para sistemas fotovoltaicos residenciales, facilitando el acceso a energía limpia.</p>
                </div>
            </article>

            <article class="news-card">
                <div class="news-card-header news-card-header-herramientas">
                    <span class="news-card-emoji">🔧</span>
                </div>
                <div class="news-card-body">
                    <span class="news-tag news-tag-herramientas">Herramientas</span>
                    <h4>Herramientas inalámbricas de 20V</h4>
                    <p>El mercado de herramientas inalámbricas sigue creciendo gracias a su autonomía, potencia y eficiencia en obra.</p>
                </div>
            </article>
        </div>
    </main>
</body>
</html>
