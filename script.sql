-- Crear la base de datos
CREATE DATABASE L2_ClinicaUM18002;
USE L2_ClinicaUM18002;

-- Tabla de Especialidades
CREATE TABLE especialidades (
    id_especialidad INT AUTO_INCREMENT NOT NULL,
    nombre_especialidad VARCHAR(50) NOT NULL,
    descripcion VARCHAR(200),
    estado TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_especialidad)
);

-- Tabla de Doctores
CREATE TABLE medicos (
    id_medico INT AUTO_INCREMENT NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    numero_jvpm VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(8) NOT NULL,
    correo VARCHAR(100),
    id_especialidad INT NOT NULL,
    estado TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_medico),
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id_especialidad)
);

-- Tabla de Pacientes
CREATE TABLE pacientes (
    id_paciente INT AUTO_INCREMENT NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    dui VARCHAR(9) NOT NULL UNIQUE,
    telefono VARCHAR(8) NOT NULL,
    correo VARCHAR(100),
    direccion VARCHAR(200),
    estado TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_paciente)
);

-- Tabla de Citas
CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    id_paciente INT NOT NULL,
    id_medico INT NOT NULL,
    estado_cita ENUM('programada', 'completada', 'cancelada') DEFAULT 'programada',
    motivo_consulta VARCHAR(200),
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_cita),
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente),
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico)
);

-- Insertar datos de ejemplo en Especialidades
INSERT INTO especialidades (nombre_especialidad, descripcion) VALUES
('Cardiología', 'Especialidad en enfermedades del corazón'),
('Pediatría', 'Atención médica de niños y adolescentes'),
('Dermatología', 'Tratamiento de enfermedades de la piel'),
('Neurología', 'Especialidad en sistema nervioso'),
('Oftalmología', 'Tratamiento de enfermedades de los ojos');

-- Insertar datos de ejemplo en Médicos
INSERT INTO medicos (nombre_completo, numero_jvpm, telefono, correo, id_especialidad) VALUES
('Dr. Juan Pérez', '12345', '22345678', 'juan.perez@clinica.com', 1),
('Dra. María García', '23456', '22345679', 'maria.garcia@clinica.com', 2),
('Dr. Carlos López', '34567', '22345680', 'carlos.lopez@clinica.com', 3),
('Dra. Ana Martínez', '45678', '22345681', 'ana.martinez@clinica.com', 4),
('Dr. Roberto Sánchez', '56789', '22345682', 'roberto.sanchez@clinica.com', 5);

-- Insertar datos de ejemplo en Pacientes
INSERT INTO pacientes (nombre_completo, fecha_nacimiento, dui, telefono, correo, direccion) VALUES
('Pedro Hernández', '1990-05-15', '123456789', '71234567', 'pedro@email.com', 'San Salvador'),
('María Torres', '1985-08-22', '234567890', '71234568', 'maria@email.com', 'Santa Tecla'),
('José Ramírez', '1995-03-10', '345678901', '71234569', 'jose@email.com', 'Soyapango'),
('Laura Castro', '1988-11-30', '456789012', '71234570', 'laura@email.com', 'Mejicanos'),
('Carmen Díaz', '1992-07-25', '567890123', '71234571', 'carmen@email.com', 'Antiguo Cuscatlán');

-- Insertar datos de ejemplo en Citas
INSERT INTO citas (fecha_cita, hora_cita, id_paciente, id_medico, estado_cita, motivo_consulta) VALUES
('2024-11-10', '09:00:00', 1, 1, 'programada', 'Control rutinario'),
('2024-11-10', '10:00:00', 2, 2, 'programada', 'Consulta general'),
('2024-11-10', '11:00:00', 3, 3, 'programada', 'Seguimiento'),
('2024-11-11', '09:00:00', 4, 4, 'programada', 'Primera consulta'),
('2024-11-11', '10:00:00', 5, 5, 'programada', 'Control mensual');
