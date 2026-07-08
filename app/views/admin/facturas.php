<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php
    $salesSummary = $salesSummary ?? ['total_ventas' => 0, 'total_facturado' => 0];
    $recentSales = $recentSales ?? [];
    ?>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>

        <main class="admin-content">
            <div class="admin-header">
                <div>
                    <h1>Facturación</h1>
                    <p>Resumen simple de ventas y facturas</p>
                </div>
            </div>

            <section class="stats-grid">
                <article class="stat-card">
                    <span class="stat-label">Ventas</span>
                    <strong><?php echo (int)$salesSummary['total_ventas']; ?></strong>
                </article>
                <article class="stat-card">
                    <span class="stat-label">Total facturado</span>
                    <strong>$<?php echo number_format((float)$salesSummary['total_facturado'], 2); ?></strong>
                </article>
            </section>

            <section class="panel-card">
                <h2>Últimos movimientos</h2>
                <?php if (!empty($recentSales)): ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Detalle</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentSales as $sale): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sale['cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($sale['detalle'] ?? ''); ?></td>
                                    <td>$<?php echo number_format((float)$sale['total'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($sale['fecha_venta']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="muted">No hay ventas registradas todavía.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
