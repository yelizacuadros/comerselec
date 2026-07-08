<?php
$currentUrl = $_GET['url'] ?? 'admin/panel';
$user = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin';
?>
<?php require_once __DIR__ . '/_sidebar.php'; ?>
