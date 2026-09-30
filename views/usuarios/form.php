<?php
$title = (!empty($usuario['id_usuario'])) ? 'Editar usuario' : 'Nuevo usuario';
require __DIR__ . '/../layout/header.php';
?>

<h1 class="section-title"><?php echo (!empty($usuario['id_usuario'])) ? 'Editar usuario' : 'Nuevo usuario'; ?></h1>

<form method="POST" action="index.php?controller=usuarios&action=save">
    <?php if (!empty($usuario['id_usuario'])): ?>
        <input type="hidden" name="id_usuario" value="<?php echo (int) $usuario['id_usuario']; ?>">
    <?php endif; ?>

    <div class="form-grid">
        <label>
            Nombre
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </label>

        <label>
            Documento
            <input type="text" name="numero_documento" value="<?php echo htmlspecialchars($usuario['numero_documento']); ?>" required>
        </label>

        <label>
            Teléfono
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>
        </label>

        <label>
            Correo
            <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
        </label>

        <label>
            Contraseña
            <input type="password" name="contrasenia" value="<?php echo htmlspecialchars($usuario['contrasenia'] ?? ''); ?>" <?php echo empty($usuario['id_usuario']) ? 'required' : ''; ?>>
        </label>

        <label>
            Rol
            <select name="id_rol" required>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?php echo (int) $rol['id_rol']; ?>" <?php echo ((int) $usuario['id_rol'] === (int) $rol['id_rol']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Estado
            <select name="activo">
                <option value="1" <?php echo (!empty($usuario['activo'])) ? 'selected' : ''; ?>>Activo</option>
                <option value="0" <?php echo (empty($usuario['activo'])) ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">Guardar</button>
        <a href="index.php?controller=usuarios&action=index" class="btn secondary">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
