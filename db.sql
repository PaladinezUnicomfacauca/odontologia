CREATE DATABASE IF NOT EXISTS odontologia;

USE odontologia;

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO roles (nombre_rol)
VALUES
    ('Administrador'),
    ('Odontólogo'),
    ('Paciente');

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    numero_documento VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(50) NOT NULL UNIQUE,
    contrasenia VARCHAR(50) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_rol INT NOT NULL,
    CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol)
        REFERENCES roles(id_rol)
);

CREATE TABLE estados_cita (
    id_estado_cita INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado_cita VARCHAR(30) NOT NULL UNIQUE
);

INSERT INTO estados_cita (nombre_estado_cita)
VALUES
    ('Pendiente'),
    ('Atendida'),
    ('Cancelada');

CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo VARCHAR(255),
    id_usuario_paciente INT NOT NULL,
    id_usuario_odontologo INT NOT NULL,
    id_usuario_administrador INT NOT NULL,
    id_estado_cita INT NOT NULL,
    CONSTRAINT fk_cita_paciente FOREIGN KEY (id_usuario_paciente)
        REFERENCES usuarios(id_usuario)
        ON DELETE RESTRICT,
    CONSTRAINT fk_cita_odontologo FOREIGN KEY (id_usuario_odontologo)
        REFERENCES usuarios(id_usuario)
        ON DELETE RESTRICT,
    CONSTRAINT fk_cita_administrador FOREIGN KEY (id_usuario_administrador)
        REFERENCES usuarios(id_usuario)
        ON DELETE RESTRICT,
    CONSTRAINT fk_cita_estado FOREIGN KEY (id_estado_cita)
        REFERENCES estados_cita(id_estado_cita)
        ON DELETE RESTRICT,
    CONSTRAINT uq_odontologo_fecha_hora UNIQUE (id_usuario_odontologo, fecha, hora)
);

INSERT INTO usuarios (
    nombre,
    numero_documento,
    telefono,
    correo,
    contrasenia,
    id_rol
)
VALUES
-- Administradores
(
    'Carlos Ramirez',
    '1001001001',
    '3001001001',
    'carlos.ramirez@odontologia.com',
    '123456',
    1
),
(
    'Laura Martinez',
    '1001001002',
    '3001001002',
    'laura.martinez@odontologia.com',
    '123456',
    1
),

-- Odontólogos
(
    'Andres Gomez',
    '1001001003',
    '3001001003',
    'andres.gomez@odontologia.com',
    '123456',
    2
),
(
    'Maria Rodriguez',
    '1001001004',
    '3001001004',
    'maria.rodriguez@odontologia.com',
    '123456',
    2
),
(
    'Juan Perez',
    '1001001005',
    '3001001005',
    'juan.perez@odontologia.com',
    '123456',
    2
),

-- Pacientes
(
    'Sofia Torres',
    '1001001006',
    '3001001006',
    'sofia.torres@gmail.com',
    '123456',
    3
),
(
    'Daniel Lopez',
    '1001001007',
    '3001001007',
    'daniel.lopez@gmail.com',
    '123456',
    3
),
(
    'Valentina Castro',
    '1001001008',
    '3001001008',
    'valentina.castro@gmail.com',
    '123456',
    3
),
(
    'Sebastian Moreno',
    '1001001009',
    '3001001009',
    'sebastian.moreno@gmail.com',
    '123456',
    3
),
(
    'Camila Herrera',
    '1001001010',
    '3001001010',
    'camila.herrera@gmail.com',
    '123456',
    3
);

INSERT INTO citas (
    fecha,
    hora,
    motivo,
    id_usuario_paciente,
    id_usuario_odontologo,
    id_usuario_administrador,
    id_estado_cita
)
VALUES

-- Cita 1
(
    '2026-09-23',
    '08:00:00',
    'Limpieza dental',
    6,
    3,
    1,
    1
),

-- Cita 2
(
    '2026-09-23',
    '09:00:00',
    'Dolor de muela',
    7,
    4,
    1,
    1
),

-- Cita 3
(
    '2026-09-23',
    '10:00:00',
    'Revision general',
    8,
    5,
    2,
    2
),

-- Cita 4
(
    '2026-09-24',
    '08:30:00',
    'Control odontologico',
    9,
    3,
    2,
    2
),

-- Cita 5
(
    '2026-09-24',
    '10:30:00',
    'Caries dental',
    10,
    4,
    1,
    1
),

-- Cita 6
(
    '2026-09-25',
    '09:00:00',
    'Limpieza dental',
    6,
    5,
    1,
    2
),

-- Cita 7
(
    '2026-09-25',
    '11:00:00',
    'Extraccion dental',
    7,
    3,
    2,
    3
),

-- Cita 8
(
    '2026-09-26',
    '08:00:00',
    'Blanqueamiento dental',
    8,
    4,
    2,
    1
),

-- Cita 9
(
    '2026-09-26',
    '10:00:00',
    'Dolor de muela',
    9,
    5,
    1,
    3
),

-- Cita 10
(
    '2026-09-27',
    '09:30:00',
    'Revision general',
    10,
    3,
    2,
    1
);
