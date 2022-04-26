DROP DATABASE IF EXISTS db_vaira;
CREATE DATABASE db_vaira;
USE db_vaira;

DROP TABLE IF EXISTS permiso;
CREATE TABLE permiso (
    idPermiso  INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    crear       TINYINT     NOT NULL,
    modificar   TINYINT     NOT NULL,
    eliminar    TINYINT     NOT NULL,
    leer        TINYINT     NOT NULL
)ENGINE = INNODB;

DROP TABLE IF EXISTS tipo;
CREATE TABLE tipo(
    idTipo      INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkPermiso  INT         NOT NULL,
    tipo        VARCHAR(20) NOT NULL,

    FOREIGN KEY (fkPermiso) REFERENCES permiso(idPermiso)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario(
    idUsuario   INT     NOT NULL        PRIMARY KEY,
    fkTipo      INT     NOT NULL
    usuario     VARCHAR(50) NOT NULL,
    password    VARCHAR(128) NOT NULL,
    nombre      VARCHAR(50)  NOT NULL,
    apellidoP   VARCHAR(50)  NOT NULL,
    apellidoM   VARCHAR(50)  NOT NULL,
    correo      VARCHAR(50)  NOT NULL,
    telefono    VARCHAR(10)  NOT NULL,
    activo      TINYINT      NOT NULL,

    FOREIGN KEY (fkTipo) REFERENCES tipo(idTipo)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

DROP TABLE IF EXISTS log_usuario;
CREATE TABLE log_usuario(
    idLog       INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkUsuario   INT         NOT NULL,
    crear       DATE,
    modificar   DATE,
    desactivar  DATE,

    FOREIGN KEY (fkUsuario) REFERENCES usuario(fkTipo)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

DROP TABLE IF EXISTS carrito;
CREATE TABLE carrito(
    idCarrito   INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkProducto  INT         NOT NULL,
    fkUsuario   INT         NOT NULL,
    cantidad    INT,

    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkUsuario) REFERENCES usuario(idUsuario) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

DROP TABLE IF EXISTS sucursal;
CREATE TABLE sucursal(
    idSucursal  INT         NOT NULL        PRIMARY KEY      AUTO_INCREMENT,
    fkRegion    INT         NOT NULL,
    nombre      VARCHAR(100) NOT NULL,
    calle       VARCHAR(100) NOT NULL,
    colonia     VARCHAR(100) NOT NULL,
    CP          VARCHAR(10)  NOT NULL,
    telefono    VARCHAR(15)  NOT NULL,

    FOREIGN KEY (fkRegion) REFERENCES region_iva(idRegion)   ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

DROP TABLE IF EXISTS sucursal_usuario;
CREATE TABLE sucursal_usuario(
    fkSucursal      INT,
    fkUsuario       INT,
    nombre          VARCHAR(),

    
)ENGINE = INNODB;












DROP DATABASE IF EXISTS categoria;
CREATE DATABASE categoria(
    idCategoria INT AUTO_INCREMENT,
    ieps        DOUBLE,
    isr         DOUBLE,
    impuestoIVA TINYINT
    PRIMARY KEY(idCategoria)
);

DROP DATABASE IF EXISTS proveedor;
CREATE DATABASE proveedor(
    idProveedor INT AUTO_INCREMENT,
    nombre      VARCHAR(50),
    telefono    VARCHAR(15),
    correo      VARCHAR(50),
    PRIMARY KEY(idProveedor)
);


DROP DATABASE IF EXISTS producto;
CREATE DATABASE producto(
    idProducto INT AUTO_INCREMENT,
    fkCategoria INT,
    fkProveedor INT,
    nombre      VARCHAR(50),
    costo       DECIMAL(10,2),
    precio      DECIMAL(10,2),
    imagen      BLOB,
    activo      TINYINT,
    servicio    TINYINT
    PRIMARY KEY(idCategoria),
    FOREIGN KEY (fkCategoria) REFERENCES categoria(idCategoria)   ON UPDATE CASCADE ON DELETE RESTRICT

);







DROP DATABASE IF EXISTS log_producto;
CREATE DATABASE log_producto(
    idLog INT AUTO_INCREMENT,
    fkProducto  INT,
    crear       DATE,
    modificar       DATE,
    desactivar       DATE,
    PRIMARY KEY(idLog),
    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto)  ON UPDATE CASCADE ON DELETE RESTRICT

);




DROP DATABASE IF EXISTS impuesto_extra;
CREATE DATABASE impuesto_extra(
    idImpuesto INT AUTO_INCREMENT,
    fkProducto  INT,
    nombre      VARCHAR(50),
    descripcion TEXT,
    impuesto    DOUBLE,
    PRIMARY KEY(idImpuesto),
    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto)  ON UPDATE CASCADE ON DELETE RESTRICT
);
















