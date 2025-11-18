CREATE DATABASE portal_noticias;
USE portal_noticias;
CREATE TABLE usuarios (
    dni VARCHAR(9),
    nombre VARCHAR(20),
    apellido VARCHAR(50),
    telefono VARCHAR(9),
    nombre_usuario VARCHAR(70),
    contrasena VARCHAR(80)
    CONSTRAINT pk_usuarios_dni PRIMARY KEY(dni),
    
)