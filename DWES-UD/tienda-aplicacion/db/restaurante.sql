-- Tabla USUARIOS --
CREATE TABLE restaurantes
(
    CodRes INT AUTO_INCREMENT,
    Correo VARCHAR(90),
    Clave VARCHAR(45),
    Pais VARCHAR(45),
    CP INT,
    Ciudad VARCHAR(45),
    Direccion VARCHAR(200),
    CONSTRAINT pk_tienda_restaurantes PRIMARY KEY(CodRes),
    CONSTRAINT uk_tienda_correo UNIQUE KEY(correo)
)ENGINE=INNODB;
-- Tabla CATEGORIAS --
CREATE TABLE categorias
(
    CodCat INT AUTO_INCREMENT,
    Nombre VARCHAR(45),
    Descripcion VARCHAR(90),
    CONSTRAINT pk_tienda_categorias PRIMARY KEY(CodCat)
)ENGINE=INNODB;
-- Tabla PRODUCTOS --
CREATE TABLE productos 
(
    CodProd INT AUTO_INCREMENT,
    Nombre VARCHAR(45),
    Descripcion VARCHAR(90),
    Peso INT,
    Stock INT,
    Categoria INT,
    CONSTRAINT pk_tienda_productos PRIMARY KEY(CodProd),
    CONSTRAINT uk_tienda_productos UNIQUE KEY(Categoria),
    CONSTRAINT fk_tienda_categorias FOREIGN KEY(Categoria) REFERENCES categorias(CodCat)
)ENGINE=INNODB;
-- Tabla Pedidos - Productos --
CREATE TABLE pedidosproductos
(
    CodPedProd INT AUTO_INCREMENT,
    Pedido INT,
    Producto INT,
    Unidades INT,
    CONSTRAINT pk_tienda_pedidosproductos PRIMARY KEY(CodPedProd),
    CONSTRAINT fk_tienda_productos FOREIGN KEY(Producto) REFERENCES productos(CodProd),
    CONSTRAINT fk_tienda_pedidos FOREIGN KEY(Pedido) REFERENCES pedidos(CodPed)
)ENGINE=INNODB;

-- Tabla PEDIDOS --
CREATE TABLE pedidos 
(
    CodPed INT AUTO_INCREMENT,
    Fecha DATE,
    Enviado INT,
    Restaurante INT,
    CONSTRAINT pk_tienda_pedidos PRIMARY KEY(CodPed),
    CONSTRAINT fk_tienda_usuarios FOREIGN KEY(Restaurante) REFERENCES restaurantes(CodRes)
)
INSERT INTO restaurantes (Correo, Clave, Pais, CP, Ciudad, Direccion) VALUES
('elaguila@outlook.es','AER1','España', 03502, 'Benidorm', 'C. De la Alegría, 23'),
('sanesteban@outlook.es','AER1','España', 03502, 'Benidorm', 'C. De Don Simón, 1'),
('xijinping@restaurantechina.es','AER1','España', 08005, 'Barcelona', 'C. Del Sitio , 20');
INSERT INTO categorias (Nombre, Descripcion) VALUES
("Bebidas sin alcohol", "Bebidas"),
("Bebidas con alcohol", "Bebidas"),
("Carne", "Para comer"),
("Pescado", "Para comer");