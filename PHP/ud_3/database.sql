CREATE DATABASE desarollowebentornoservidor;
CREATE TABLE usuarios (
    id INT  AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    edad INT NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol BOOLEAN,
    email VARCHAR(255) NOT NULL
);