<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Catálogo</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php $categories = $categories ?? []; ?>
    <?php $products = $products ?? []; ?>
    <?php
    $assetUrl = function ($path) {
        if (empty($path)) {
            return '';
        }
        if (preg_match('/^https?:\\/\\//i', $path)) {
            return $path;
        }
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'img/')) {
            return '/public/' . $path;
        }
        if (str_starts_with($path, 'public/')) {
            return '/' . $path;
        }
        return '/public/' . $path;
    };
    ?>

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
                    <li><a href="index.php?url=noticias">NOTICIAS</a></li>
                    <li><a href="index.php?url=contacto">CONTACTO</a></li>
                    <li><a href="index.php?url=admin/login" class="btn-login">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="hero">
        <div class="container">
            <h2>¡TU PROVEEDOR DE CONFIANZA!</h2>
        </div>
    </div>

    <main class="container content">
        <?php $keyword = htmlspecialchars($_GET['q'] ?? ''); ?>
        <aside class="sidebar">
            <h3>Categorías</h3>
            <ul class="category-list">
                <li><a href="index.php?url=catalogo">Todas las categorías</a></li>
                <?php foreach($categories as $cat): ?>
                    <li><a href="index.php?url=catalogo&cat=<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <div class="catalog-right">
            <div class="search-bar-inline">
                <form class="search-form" method="GET" action="index.php">
                    <input type="hidden" name="url" value="catalogo">
                    <div class="search-input-group">
                        <input
                            type="text"
                            name="q"
                            id="search-input"
                            class="search-input"
                            placeholder="Buscar productos: cables, LED, taladro..."
                            value="<?php echo $keyword; ?>"
                            autocomplete="off"
                        >
                        <button type="submit" class="search-btn">Buscar</button>
                        <?php if ($keyword): ?>
                            <a href="index.php?url=catalogo" class="search-clear-btn">×</a>
                        <?php endif; ?>
                    </div>
                </form>
                <?php if ($keyword): ?>
                    <p class="search-results-info">
                        Resultados para: <strong>"<?php echo $keyword; ?>"</strong> - <?php echo count($products); ?> producto(s)
                    </p>
                <?php endif; ?>
            </div>

        <section class="products-grid">
            <?php if(count($products) > 0): ?>
                <?php foreach($products as $prod): ?>
                    <div class="product-card">
                            <div class="product-img-placeholder" style="<?php if(!empty($prod['image_url'])) echo 'background-image: url('.htmlspecialchars($assetUrl($prod['image_url'])).'); background-size: cover; background-position: center;'; ?>">
                            <?php if(empty($prod['image_url'])): ?>
                                <span>⚡</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <span class="category-badge"><?php echo htmlspecialchars($prod['category_name']); ?></span>
                            <h4><?php echo htmlspecialchars($prod['name']); ?></h4>
                            <p class="desc"><?php echo htmlspecialchars($prod['description']); ?></p>
                            <div class="price-stock">
                                <span class="price">$<?php echo number_format($prod['price'], 2); ?></span>
                                <span class="stock">Stock: <?php echo $prod['stock'] ?? 0; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>No se encontraron productos en esta categoría.</p>
            <?php endif; ?>
        </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> COMERSELEC S.A. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
