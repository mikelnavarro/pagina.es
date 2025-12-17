-- Tabla USUARIOS --
CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    -- Incrementable --
    nombre VARCHAR(100) NOT NULL,
    -- Nombre no nulo --
    correo_electronico VARCHAR(255) NOT NULL UNIQUE KEY,
    -- correo no nulo unico --
    telefono VARCHAR(20) NOT NULL,
    usuario VARCHAR(255) NOT NULL UNIQUE KEY,
    PASSWORD VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE,
    path_foto_perfil VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;