<?php

class Usuario
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function authenticate(string $correo, string $contrasenia): ?array
    {
        $sql = "
            SELECT u.*, r.nombre_rol
            FROM usuarios u
            INNER JOIN roles r ON r.id_rol = u.id_rol
            WHERE u.correo = :correo AND u.contrasenia = :contrasenia
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':correo' => $correo,
            ':contrasenia' => $contrasenia,
        ]);

        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    public function getAll(): array
    {
        $sql = "
            SELECT u.*, r.nombre_rol
            FROM usuarios u
            INNER JOIN roles r ON r.id_rol = u.id_rol
            ORDER BY u.id_usuario DESC
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT u.*, r.nombre_rol
            FROM usuarios u
            INNER JOIN roles r ON r.id_rol = u.id_rol
            WHERE u.id_usuario = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    public function getRoles(): array
    {
        $stmt = $this->db->query('SELECT * FROM roles ORDER BY id_rol');
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO usuarios (nombre, numero_documento, telefono, correo, contrasenia, activo, id_rol)
            VALUES (:nombre, :numero_documento, :telefono, :correo, :contrasenia, :activo, :id_rol)
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':numero_documento' => $data['numero_documento'],
            ':telefono' => $data['telefono'],
            ':correo' => $data['correo'],
            ':contrasenia' => $data['contrasenia'],
            ':activo' => (int) ($data['activo'] ?? 1),
            ':id_rol' => (int) ($data['id_rol'] ?? 3),
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE usuarios
            SET nombre = :nombre,
                numero_documento = :numero_documento,
                telefono = :telefono,
                correo = :correo,
                contrasenia = :contrasenia,
                activo = :activo,
                id_rol = :id_rol
            WHERE id_usuario = :id
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':numero_documento' => $data['numero_documento'],
            ':telefono' => $data['telefono'],
            ':correo' => $data['correo'],
            ':contrasenia' => $data['contrasenia'],
            ':activo' => (int) ($data['activo'] ?? 1),
            ':id_rol' => (int) ($data['id_rol'] ?? 3),
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM usuarios WHERE id_usuario = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) AS total FROM usuarios');
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }

    public function countByRole(int $idRol): int
    {
        $sql = 'SELECT COUNT(*) AS total FROM usuarios WHERE id_rol = :id_rol';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_rol' => $idRol]);
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    }
}
