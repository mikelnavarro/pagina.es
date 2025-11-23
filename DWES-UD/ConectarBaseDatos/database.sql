CREATE DATABASE dweb;
CREATE TABLE libros
(
    id INT AUTO_INCREMENT,
    titulo VARCHAR(255) UNIQUE KEY,
    autor VARCHAR(255) DEFAULT 'Desconocido',
    n_paginas INT DEFAULT 0,
    fecha_publicacion DATE DEFAULT '2001-01-01',
    terminado BOOLEAN,
    CONSTRAINT pk_libros_id PRIMARY KEY(id)
    
)Engine=InnoDB;