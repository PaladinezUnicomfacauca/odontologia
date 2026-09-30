<?php
if (!isset($title)) {
    $title = 'Clínica Odontológica';
}
$usuarioActual = $_SESSION['nombre'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="topbar">
        <div class="brand">Clínica Odontológica</div>
        <nav class="nav">
            <?php if (!empty($_SESSION['usuario_id'])): ?>
                <a href="index.php?controller=home&action=index">Inicio</a>
                <a href="index.php?controller=usuarios&action=index">Usuarios</a>
                <a href="index.php?controller=citas&action=index">Citas</a>
                <span class="muted">Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario'); ?></span>
                <a href="index.php?controller=auth&action=logout">Cerrar sesión</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="container">
