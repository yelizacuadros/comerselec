<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php $products = $products ?? []; ?>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div>Usuario Activo</div>
            </div>
            
            <div class="dashboard-container">
                <h2>Panel de Control</h2>
                <p>Bienvenido al sistema de administración.</p><br>
                <p><strong>Acceso: Administrador</strong></p>
            </div>
        </main>
    </div>
</body>
</html>
