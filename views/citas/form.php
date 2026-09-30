<?php
$title = (!empty($cita['id_cita'])) ? 'Editar cita' : 'Nueva cita';
require __DIR__ . '/../layout/header.php';
?>

<h1 class="section-title"><?php echo (!empty($cita['id_cita'])) ? 'Editar cita' : 'Nueva cita'; ?></h1>

<form method="POST" action="index.php?controller=citas&action=save">
    <?php if (!empty($cita['id_cita'])): ?>
        <input type="hidden" name="id_cita" value="<?php echo (int) $cita['id_cita']; ?>">
    <?php endif; ?>

    <div class="form-grid">
        <label>
            Fecha
            <input type="date" name="fecha" value="<?php echo htmlspecialchars($cita['fecha']); ?>" required>
        </label>

        <label>
            Hora
            <input type="time" name="hora" value="<?php echo htmlspecialchars($cita['hora']); ?>" required>
        </label>

        <label>
            Paciente
            <select name="id_usuario_paciente" required>
                <option value="">Seleccione uno</option>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?php echo (int) $paciente['id_usuario']; ?>" <?php echo ((int) ($cita['id_usuario_paciente'] ?? 0) === (int) $paciente['id_usuario']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($paciente['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Odontólogo
            <select name="id_usuario_odontologo" required>
                <option value="">Seleccione uno</option>
                <?php foreach ($odontologos as $odontologo): ?>
                    <option value="<?php echo (int) $odontologo['id_usuario']; ?>" <?php echo ((int) ($cita['id_usuario_odontologo'] ?? 0) === (int) $odontologo['id_usuario']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($odontologo['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Administrador
            <select name="id_usuario_administrador" required>
                <option value="">Seleccione uno</option>
                <?php foreach ($administradores as $admin): ?>
                    <option value="<?php echo (int) $admin['id_usuario']; ?>" <?php echo ((int) ($cita['id_usuario_administrador'] ?? 0) === (int) $admin['id_usuario']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($admin['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Estado
            <select name="id_estado_cita" required>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo (int) $estado['id_estado_cita']; ?>" <?php echo ((int) ($cita['id_estado_cita'] ?? 1) === (int) $estado['id_estado_cita']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($estado['nombre_estado_cita']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label style="grid-column: 1 / -1;">
            Motivo
            <textarea name="motivo" placeholder="Detalle del motivo de la cita"><?php echo htmlspecialchars($cita['motivo'] ?? ''); ?></textarea>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">Guardar</button>
        <a href="index.php?controller=citas&action=index" class="btn secondary">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
