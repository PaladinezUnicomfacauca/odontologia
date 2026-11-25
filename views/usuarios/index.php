<?php
$title = 'Usuarios - Clínica Odontológica';
require __DIR__ . '/../layout/header.php';
?>

<div class="toolbar">
    <h1 class="section-title" style="margin:0;">Usuarios</h1>
    <a href="index.php?controller=usuarios&action=new" class="btn">Nuevo usuario</a>
</div>

<form class="table-filters" method="GET" action="index.php">
    <input type="hidden" name="controller" value="usuarios">
    <input type="hidden" name="action" value="index">

    <label>
        Buscar usuario
        <input type="search" name="search" value="<?php echo htmlspecialchars($filtros['search']); ?>" placeholder="Nombre, documento, teléfono o correo">
    </label>

    <label>
        Rol
        <select name="id_rol">
            <option value="">Todos</option>
            <?php foreach ($roles as $rol): ?>
                <option value="<?php echo (int) $rol['id_rol']; ?>" <?php echo ((int) $filtros['id_rol'] === (int) $rol['id_rol']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Estado
        <select name="activo">
            <option value="">Todos</option>
            <option value="1" <?php echo ($filtros['activo'] === '1') ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo ($filtros['activo'] === '0') ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    </label>

    <div class="filter-actions">
        <button type="submit" class="btn">Filtrar</button>
        <a href="index.php?controller=usuarios&action=index" class="btn secondary">Limpiar</a>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo (int) $usuario['id_usuario']; ?></td>
                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                <td><?php echo htmlspecialchars($usuario['numero_documento']); ?></td>
                <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                <td><?php echo htmlspecialchars($usuario['nombre_rol']); ?></td>
                <td><?php echo ($usuario['activo'] ? 'Sí' : 'No'); ?></td>
                <td>
                    <a class="btn small" href="index.php?controller=usuarios&action=edit&id=<?php echo (int) $usuario['id_usuario']; ?>">Editar</a>
                    <a class="btn small danger" href="index.php?controller=usuarios&action=delete&id=<?php echo (int) $usuario['id_usuario']; ?>" onclick="return confirm('¿Deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$usuarios): ?>
            <tr>
                <td colspan="8" class="empty-table">No se encontraron usuarios con los filtros seleccionados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
