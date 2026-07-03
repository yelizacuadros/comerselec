<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMERSELEC S.A. - Catálogo</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="container header-container">
            <div class="logo">
                <h1>COMERSELEC S.A.</h1>
                <p>Materiales Eléctricos</p>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php?action=catalog">CATÁLOGO</a></li>
                    <li><a href="index.php?action=about">NOSOTROS</a></li>
                    <li><a href="index.php?action=contact">CONTACTO</a></li>
                    <li><a href="index.php?action=login" class="btn-login">Iniciar Sesión</a></li>
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
        <aside class="sidebar">
            <h3>Categorías</h3>
            <ul class="category-list">
                <li><a href="index.php?action=catalog">Todas las categorías</a></li>
                <?php foreach($categories as $cat): ?>
                    <li><a href="index.php?action=catalog&cat=<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="products-grid">
            <?php if(count($products) > 0): ?>
                <?php foreach($products as $prod): ?>
                    <div class="product-card">
                        <div class="product-img-placeholder" style="<?php if(!empty($prod['image_url'])) echo 'background-image: url('.htmlspecialchars($prod['image_url']).'); background-size: cover; background-position: center;'; ?>">
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
                                <span class="stock">Stock: <?php echo $prod['stock']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron productos en esta categoría.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> COMERSELEC S.A. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
