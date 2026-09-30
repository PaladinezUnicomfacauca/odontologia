<?php
$title = 'Inicio - Clínica Odontológica';
require __DIR__ . '/../layout/header.php';
?>

<h1 class="section-title">Dashboard</h1>

<div class="cards">
    <div class="card">
        <h3>Usuarios</h3>
        <div class="value"><?php echo (int) ($data['totalUsuarios'] ?? 0); ?></div>
    </div>
    <div class="card">
        <h3>Odontólogos</h3>
        <div class="value"><?php echo (int) ($data['totalOdontologos'] ?? 0); ?></div>
    </div>
    <div class="card">
        <h3>Pacientes</h3>
        <div class="value"><?php echo (int) ($data['totalPacientes'] ?? 0); ?></div>
    </div>
    <div class="card">
        <h3>Citas</h3>
        <div class="value"><?php echo (int) ($data['totalCitas'] ?? 0); ?></div>
    </div>
</div>

<h2 class="section-title">Estado de citas</h2>
<table>
    <thead>
        <tr>
            <th>Estado</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (($data['estadoCitas'] ?? []) as $estado): ?>
            <tr>
                <td><?php echo htmlspecialchars($estado['nombre_estado_cita']); ?></td>
                <td><?php echo (int) $estado['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2 class="section-title">Últimas citas</h2>
<table>
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Odontólogo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (($data['ultimasCitas'] ?? []) as $cita): ?>
            <tr>
                <td><?php echo htmlspecialchars($cita['paciente']); ?></td>
                <td><?php echo htmlspecialchars($cita['odontologo']); ?></td>
                <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                <td><span class="badge"><?php echo htmlspecialchars($cita['estado']); ?></span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
