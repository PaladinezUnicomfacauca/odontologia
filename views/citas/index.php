<?php
$title = 'Citas - Clínica Odontológica';
require __DIR__ . '/../layout/header.php';
?>

<div class="toolbar">
    <h1 class="section-title" style="margin:0;">Citas</h1>
    <a href="index.php?controller=citas&action=new" class="btn">Nueva cita</a>
</div>

<form class="table-filters" method="GET" action="index.php">
    <input type="hidden" name="controller" value="citas">
    <input type="hidden" name="action" value="index">

    <label>
        Buscar persona
        <input type="search" name="search" value="<?php echo htmlspecialchars($filtros['search']); ?>" placeholder="Paciente, odontólogo o administrador">
    </label>

    <label>
        Motivo
        <select name="motivo">
            <option value="">Todos</option>
            <?php foreach ($motivos as $motivo): ?>
                <option value="<?php echo htmlspecialchars($motivo['motivo']); ?>" <?php echo ($filtros['motivo'] === $motivo['motivo']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($motivo['motivo']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Estado
        <select name="id_estado_cita">
            <option value="">Todos</option>
            <?php foreach ($estados as $estado): ?>
                <option value="<?php echo (int) $estado['id_estado_cita']; ?>" <?php echo ((int) $filtros['id_estado_cita'] === (int) $estado['id_estado_cita']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($estado['nombre_estado_cita']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Fecha
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($filtros['fecha']); ?>">
    </label>

    <div class="filter-actions">
        <button type="submit" class="btn">Filtrar</button>
        <a href="index.php?controller=citas&action=index" class="btn secondary">Limpiar</a>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Paciente</th>
            <th>Odontólogo</th>
            <th>Administrador</th>
            <th>Motivo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($citas as $cita): ?>
            <tr>
                <td><?php echo (int) $cita['id_cita']; ?></td>
                <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                <td><?php echo htmlspecialchars($cita['paciente']); ?></td>
                <td><?php echo htmlspecialchars($cita['odontologo']); ?></td>
                <td><?php echo htmlspecialchars($cita['administrador']); ?></td>
                <td><?php echo htmlspecialchars($cita['motivo'] ?? 'Sin motivo'); ?></td>
                <td><span class="badge"><?php echo htmlspecialchars($cita['estado']); ?></span></td>
                <td>
                    <a class="btn small" href="index.php?controller=citas&action=edit&id=<?php echo (int) $cita['id_cita']; ?>">Editar</a>
                    <a class="btn small danger" href="index.php?controller=citas&action=delete&id=<?php echo (int) $cita['id_cita']; ?>" onclick="return confirm('¿Deseas eliminar esta cita?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$citas): ?>
            <tr>
                <td colspan="9" class="empty-table">No se encontraron citas con los filtros seleccionados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
