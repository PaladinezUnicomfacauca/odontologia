<?php
$title = 'Citas - Clínica Odontológica';
require __DIR__ . '/../layout/header.php';
?>

<div class="toolbar">
    <h1 class="section-title" style="margin:0;">Citas</h1>
    <a href="index.php?controller=citas&action=new" class="btn">Nueva cita</a>
</div>

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
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
