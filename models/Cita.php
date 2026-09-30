<?php

class Cita
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT c.*, 
                   p.nombre AS paciente,
                   o.nombre AS odontologo,
                   a.nombre AS administrador,
                   e.nombre_estado_cita AS estado
            FROM citas c
            INNER JOIN usuarios p ON p.id_usuario = c.id_usuario_paciente
            INNER JOIN usuarios o ON o.id_usuario = c.id_usuario_odontologo
            INNER JOIN usuarios a ON a.id_usuario = c.id_usuario_administrador
            INNER JOIN estados_cita e ON e.id_estado_cita = c.id_estado_cita
            ORDER BY c.fecha DESC, c.hora DESC
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT c.*, 
                   p.nombre AS paciente,
                   o.nombre AS odontologo,
                   a.nombre AS administrador,
                   e.nombre_estado_cita AS estado
            FROM citas c
            INNER JOIN usuarios p ON p.id_usuario = c.id_usuario_paciente
            INNER JOIN usuarios o ON o.id_usuario = c.id_usuario_odontologo
            INNER JOIN usuarios a ON a.id_usuario = c.id_usuario_administrador
            INNER JOIN estados_cita e ON e.id_estado_cita = c.id_estado_cita
            WHERE c.id_cita = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $cita = $stmt->fetch();
        return $cita ?: null;
    }

    public function getUsuariosByRol(int $idRol): array
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id_rol = :id_rol ORDER BY nombre');
        $stmt->execute([':id_rol' => $idRol]);
        return $stmt->fetchAll();
    }

    public function getEstados(): array
    {
        $stmt = $this->db->query('SELECT * FROM estados_cita ORDER BY id_estado_cita');
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO citas (fecha, hora, motivo, id_usuario_paciente, id_usuario_odontologo, id_usuario_administrador, id_estado_cita)
            VALUES (:fecha, :hora, :motivo, :id_usuario_paciente, :id_usuario_odontologo, :id_usuario_administrador, :id_estado_cita)
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':fecha' => $data['fecha'],
            ':hora' => $data['hora'],
            ':motivo' => $data['motivo'],
            ':id_usuario_paciente' => (int) ($data['id_usuario_paciente'] ?? 0),
            ':id_usuario_odontologo' => (int) ($data['id_usuario_odontologo'] ?? 0),
            ':id_usuario_administrador' => (int) ($data['id_usuario_administrador'] ?? 0),
            ':id_estado_cita' => (int) ($data['id_estado_cita'] ?? 1),
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE citas
            SET fecha = :fecha,
                hora = :hora,
                motivo = :motivo,
                id_usuario_paciente = :id_usuario_paciente,
                id_usuario_odontologo = :id_usuario_odontologo,
                id_usuario_administrador = :id_usuario_administrador,
                id_estado_cita = :id_estado_cita
            WHERE id_cita = :id
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':fecha' => $data['fecha'],
            ':hora' => $data['hora'],
            ':motivo' => $data['motivo'],
            ':id_usuario_paciente' => (int) ($data['id_usuario_paciente'] ?? 0),
            ':id_usuario_odontologo' => (int) ($data['id_usuario_odontologo'] ?? 0),
            ':id_usuario_administrador' => (int) ($data['id_usuario_administrador'] ?? 0),
            ':id_estado_cita' => (int) ($data['id_estado_cita'] ?? 1),
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM citas WHERE id_cita = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function getLatest(int $limit = 5): array
    {
        $sql = "
            SELECT c.*, 
                   p.nombre AS paciente,
                   o.nombre AS odontologo,
                   e.nombre_estado_cita AS estado
            FROM citas c
            INNER JOIN usuarios p ON p.id_usuario = c.id_usuario_paciente
            INNER JOIN usuarios o ON o.id_usuario = c.id_usuario_odontologo
            INNER JOIN estados_cita e ON e.id_estado_cita = c.id_estado_cita
            ORDER BY c.fecha DESC, c.hora DESC
            LIMIT :limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) AS total FROM citas');
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }

    public function getTotalByState(): array
    {
        $sql = "
            SELECT e.id_estado_cita, e.nombre_estado_cita, COUNT(c.id_cita) AS total
            FROM estados_cita e
            LEFT JOIN citas c ON c.id_estado_cita = e.id_estado_cita
            GROUP BY e.id_estado_cita, e.nombre_estado_cita
            ORDER BY e.id_estado_cita
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
