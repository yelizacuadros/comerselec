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
                <li><a href="index.php?action=dashboard">Dashboard</a></li>  <!--Poner una clase para HOVER a todas--> 
                <li><a href="index.php?action=categories">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li>
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
                
                <!-- Aqui iría un if que muestra las opciones según el rol-->
                <br>
                <div class="dashboard-menu">
                    <a href="index.php?action=categories" class="dashboard-card">
                        <h3>Gestionar Categorías</h3>
                        <p>Añadir, editar o eliminar categorías.</p>
                    </a><br>
                    
                    <a href="index.php?action=products" class="dashboard-card">
                        <h3>Gestionar Productos</h3>
                        <p>Añadir, editar o eliminar productos.</p>
                    </a><br>

                    <a href="index.php?action=messages" class="dashboard-card">
                        <h3>Mensajes de Clientes</h3>
                        <p>Ver mensajes enviados desde Contacto.</p>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
