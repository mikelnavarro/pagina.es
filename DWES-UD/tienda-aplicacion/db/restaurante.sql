
CREATE TABLE usuarios
(
    CodRes INT AUTO_INCREMENT,
    Correo VARCHAR(90),
    Clave VARCHAR(45),
    Pais VARCHAR(45),
    CP INT,
    Ciudad VARCHAR(45),
    Direccion VARCHAR(200),
    CONSTRAINT pk_tienda_restaurante PRIMARY KEY(CodRes),
    CONSTRAINT uk_tienda_correo UNIQUE KEY(correo)
)ENGINE=INNODB;
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
    CONSTRAINT fk_tienda_categoria FOREIGN KEY(Categoria) REFERENCE categorias(CodCat)
)ENGINE=INNODB;

CREATE TABLE pedidosproductos
(
    CodPedProd INT AUTO_INCREMENT,
    Pedido INT,
    Producto INT,
    Unidades INT,
    CONSTRAINT pk_tienda_pedidosproductos PRIMARY KEY(CodPedProd),
    CONSTRAINT fk_tienda_producto FOREIGN KEY(Producto) REFERENCES productos(CodPro)
)ENGINE=INNODB;
CREATE TABLE productos
(
    CodProd INT AUTO_INCREMENT,
    Nombre VARCHAR(45),
    Descripcion VARCHAR(90),
)ENGINE=INNODB;