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
















# CREATE SCHEMA db_vaira;
USE db_vaira;

DROP TABLE IF EXISTS info_venta;
DROP TABLE IF EXISTS datos_factura;
DROP TABLE IF EXISTS venta;
DROP TABLE IF EXISTS tipo_pago;
DROP TABLE IF EXISTS proveedor_producto;
DROP TABLE IF EXISTS existencia;
DROP TABLE IF EXISTS log_producto;
DROP TABLE IF EXISTS producto;
DROP TABLE IF EXISTS proveedor;
DROP TABLE IF EXISTS categoria_impuestos;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS sucursal_usuario;
DROP TABLE IF EXISTS punto_venta;
DROP TABLE IF EXISTS sucursal;
DROP TABLE IF EXISTS region_iva;
DROP TABLE IF EXISTS ciudad;
DROP TABLE IF EXISTS pais;
DROP TABLE IF EXISTS persona;
DROP TABLE IF EXISTS log_usuario;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS tipo;
DROP TABLE IF EXISTS permisos;

CREATE TABLE IF NOT EXISTS permisos(
    idPermisos  INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    crear       TINYINT     NOT NULL,
    modificar   TINYINT     NOT NULL,
    eliminar    TINYINT     NOT NULL,
    leer        TINYINT     NOT NULL
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS tipo(
    idTipo      INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkPermisos  INT         NOT NULL,
    tipo        VARCHAR(20) NOT NULL,

    FOREIGN KEY (fkPermisos) REFERENCES permisos(idPermisos)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS usuario(
    idUsuario   INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkTipo      INT         NOT NULL,
    usuario     VARCHAR(50) NOT NULL,
    password    VARCHAR(128) NOT NULL,

    FOREIGN KEY (fkTipo) REFERENCES tipo(idTipo)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS log_usuario(
    idLog       INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkUsuario   INT         NOT NULL,
    crear       DATE,
    modificar   DATE,
    desactivar  DATE,

    FOREIGN KEY (fkUsuario) REFERENCES usuario(fkTipo)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS persona(
    idPersona   INT          NOT NULL       PRIMARY KEY     AUTO_INCREMENT,
    fkUsuario   INT          NOT NULL,
    nombre      VARCHAR(50)  NOT NULL,
    apellidoP   VARCHAR(50)  NOT NULL,
    apellidoM   VARCHAR(50)  NOT NULL,
    correo      VARCHAR(50)  NOT NULL,
    telefono    VARCHAR(10)  NOT NULL,

    FOREIGN KEY (fkUsuario) REFERENCES usuario(idUsuario)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS pais(
    idPais      INT          NOT NULL       PRIMARY KEY     AUTO_INCREMENT,
    nombre      VARCHAR(50)  NOT NULL
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS ciudad(
    idCiudad    INT          NOT NULL       PRIMARY KEY     AUTO_INCREMENT,
    fkPais      INT          NOT NULL,
    nombre      VARCHAR(50)  NOT NULL,

    FOREIGN KEY (fkPais) REFERENCES pais(idPais)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS region_iva(
    idRegion    INT          NOT NULL       PRIMARY KEY     AUTO_INCREMENT,
    fkCiudad    INT          NOT NULL,
    iva         DECIMAL(5,2)  NOT NULL,

    FOREIGN KEY (fkCiudad) REFERENCES ciudad(idCiudad)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS sucursal(
    idSucursal  INT          NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkRegion    INT          NOT NULL,
    nombre      VARCHAR(100) NOT NULL,
    calle       VARCHAR(100) NOT NULL,
    colonia     VARCHAR(100) NOT NULL,
    CP          VARCHAR(10)  NOT NULL,
    telefono    VARCHAR(15)  NOT NULL,

    FOREIGN KEY (fkRegion) REFERENCES region_iva(idRegion)   ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS punto_venta(
    idUsuario   INT          NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkSucursal  INT          NOT NULL,
    fkUsuario   INT          NOT NULL,
    nombre      VARCHAR(50)  NOT NULL,

    FOREIGN KEY (fkUsuario) REFERENCES usuario(idUsuario)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkSucursal) REFERENCES sucursal(idSucursal)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS sucursal_usuario(
    fkSucursal  INT          NOT NULL,
    fkUsuario   INT          NOT NULL,

    FOREIGN KEY (fkUsuario) REFERENCES usuario(idUsuario)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkSucursal) REFERENCES sucursal(idSucursal)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS categoria(
    idCategoria INT          NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    nombre      VARCHAR(25)  NOT NULL,
    descripcion TEXT,
    impuesto    TINYINT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS categoria_impuestos(
    idCategoriaIm INT          NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    nombre        VARCHAR(25)  NOT NULL,
    ieps          DECIMAL(10,2) NOT NULL,
    isr           DECIMAL(10,2) NOT NULL
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS proveedor(
    idProveedor  INT          NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    nombre       VARCHAR(50)  NOT NULL,
    telefono     VARCHAR(50)  NOT NULL,
    correo       VARCHAR(50)  NOT NULL
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS producto (
    idProducto      INT             NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkCategoria     INT             NOT NULL,
    fkCategoriaImp  INT             NOT NULL,
    nombre          VARCHAR(50)     NOT NULL,
    costo           DECIMAL (10,2)   NOT NULL,
    precio          DECIMAL (10,2)   NOT NULL,
    imagen          BLOB,
    activo          TINYINT,
    servicio        TINYINT,

    FOREIGN KEY (fkCategoria) REFERENCES categoria(idCategoria)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkCategoriaImp) REFERENCES categoria_impuestos(idCategoriaIm)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS log_producto(
    idLog       INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkProducto  INT         NOT NULL,
    crear       DATE,
    modificar   DATE,
    desactivar  DATE,

    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS existencia(
    idExistencia    INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkProducto      INT         NOT NULL,
    fkSucursal      INT         NOT NULL,
    cantidad        INT         NOT NULL,

    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkSucursal) REFERENCES sucursal(idSucursal)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS proveedor_producto(
    fkProveedor  INT          NOT NULL,
    fkProducto   INT          NOT NULL,

    FOREIGN KEY (fkProveedor) REFERENCES proveedor(idProveedor)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkProducto)  REFERENCES producto(idProducto)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS tipo_pago(
    idTipo      INT         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    nombre      VARCHAR(20) NOT NULL

)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS venta (
    idVenta     INT         NOT NULL        PRIMARY KEY        AUTO_INCREMENT,
    fkUsuario   INT,
    fkTipoPago  INT,
    total       DECIMAL(12, 2),
    fecha       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (fkUsuario)  REFERENCES usuario(idUsuario) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkTipoPago)  REFERENCES tipo_pago(idTipo) ON UPDATE CASCADE ON DELETE RESTRICT

)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS regimen_fiscal (
    idRegimen   INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    nombre      VARCHAR(50) NOT NULL
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS datos_factura(
    idExistencia    INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkPersona       INT         NOT NULL,
    fkVenta         INT         NOT NULL,
    fkRegimen       INT         NOT NULL,
    rfc             VARCHAR(13) NOT NULL,
    cp_persona      VARCHAR(10) NOT NULL,

    FOREIGN KEY (fkPersona) REFERENCES persona(idPersona)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkVenta)  REFERENCES venta(idVenta)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkRegimen)  REFERENCES regimen_fiscal(idRegimen)   ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS info_venta(
    idInfo          INT         NOT NULL        PRIMARY KEY     AUTO_INCREMENT,
    fkProducto      INT         NOT NULL,
    fkVenta         INT         NOT NULL,
    cantidad        INT         NOT NULL,
    iva             DECIMAL(5,2) NOT NULL,
    ieps            DECIMAL(5,2) NOT NULL,
    isr             DECIMAL(5,2) NOT NULL,
    subtotal        DECIMAL(5,2) NOT NULL,

    FOREIGN KEY (fkProducto) REFERENCES producto(idProducto)   ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (fkVenta)  REFERENCES venta(idVenta)   ON UPDATE CASCADE ON DELETE RESTRICT

)ENGINE = INNODB;

# SHOW TABLES;