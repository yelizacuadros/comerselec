<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC<br><span style="font-size: 16px; color: var(--light-blue); font-weight: normal;">
            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?></span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?action=dashboard" style="background-color: rgba(255,255,255,0.1); color: white;">Dashboard</a></li>
                <li><a href="index.php?action=categories">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=messages">Mensajes</a></li>
                <li><a href="index.php?action=messages">Facturación</a></li> <!--Corregir link-->  
                <!--li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li-->
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div>Usuario Activo</div>
            </div>
            
            <div class="dashboard-container">
                <h2>Panel de Control</h2>
                <p>Bienvenido al sistema de administración. Rol actual: <strong><?php echo isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role']) : 'Administrador'; ?></strong></p>
                
                <br>
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
            </div>
        </main>
    </div>
</body>
</html>
