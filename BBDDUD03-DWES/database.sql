CREATE DATABASE actividad_hobbys;
USE actividad_hobbys;
CREATE TABLE lectura 
(
    id INT AUTO_INCREMENT,
    titulo_libro VARCHAR(255) UNIQUE KEY,
    autor VARCHAR(255),
    paginas INT,
    terminado BOOLEAN,
    fecha_lectura DATE,
    CONSTRAINT pk_hobbys_lectura PRIMARY KEY (id)
);