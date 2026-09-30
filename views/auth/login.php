<?php
$title = 'Iniciar sesión';
require __DIR__ . '/../layout/header.php';
?>

<div class="login-box">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($error)): ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=authenticate">
        <div class="form-grid">
            <label>
                Correo
                <input type="email" name="correo" placeholder="usuario@correo.com" required>
            </label>

            <label>
                Contraseña
                <input type="password" name="contrasenia" placeholder="********" required>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Entrar</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
