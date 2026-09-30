<?php
$title = 'Usuarios - Clínica Odontológica';
require __DIR__ . '/../layout/header.php';
?>

<div class="toolbar">
    <h1 class="section-title" style="margin:0;">Usuarios</h1>
    <a href="index.php?controller=usuarios&action=new" class="btn">Nuevo usuario</a>
</div>

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
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
