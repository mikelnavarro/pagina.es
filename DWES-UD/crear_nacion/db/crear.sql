
CREATE DATABASE app_naciones;
USE app_naciones;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    correo VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255),
    CONSTRAINT uk_usuarios UNIQUE KEY (correo)
)ENGINE=INNODB;
CREATE TABLE paises (
    id INT AUTO_INCREMENT,
    nombre_comun VARCHAR(255),
    nombre_oficial VARCHAR(255),
    superficie INT,
    poblacion INT,
    moneda VARCHAR(50),
    oro INT,
    usuario INT,
    CONSTRAINT pk_paises_id PRIMARY KEY (id),
    CONSTRAINT fk_paises_usuarios FOREIGN KEY (usuario) REFERENCES usuarios (id)
)ENGINE=INNODB;