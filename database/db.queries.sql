USE db_vaira;

DELIMITER //

DROP PROCEDURE IF EXISTS insertar_usuario;
CREATE PROCEDURE insertar_usuario(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE _fkTipo VARCHAR(10);
                    DECLARE jNombre VARCHAR(50);
                    DECLARE jApellidoP VARCHAR(50);
                    DECLARE jApellidoM VARCHAR(50);
                    DECLARE jCorreo VARCHAR(50);
                    DECLARE jTelefono VARCHAR(50);
                    DECLARE jUsuario VARCHAR(50);
                    DECLARE jPassword VARCHAR(50);
                    DECLARE _fkUsuario INT;
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;


                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jNombre = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.nombre'));
                    SET jApellidoP = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoP'));
                    SET jApellidoM = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoM'));
                    SET jUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.usuario'));
                    SET jPassword = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.password'));
                    SET jCorreo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.correo'));
                    SET jTelefono = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.telefono'));
                    SET _fkTipo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.rol'));

                    START TRANSACTION;
                        INSERT INTO usuario VALUES (0, _fkTipo, jUsuario, sha2(jPassword, 512), jNombre, jApellidoP, jApellidoM, jCorreo, jTelefono, 1);
                        SELECT idUsuario INTO _fkUsuario FROM usuario WHERE usuario = jUsuario;
                        INSERT INTO log_usuario VALUES (0, _fkUsuario, NOW(), NOW(), NULL);
                        SELECT * from usuario WHERE nombre = @nombre LIMIT 1;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS eliminar_usuario;
CREATE PROCEDURE eliminar_usuario(IN id INT)
                BEGIN
                DECLARE exit handler for sqlexception
                BEGIN
                    -- ERROR
                    ROLLBACK;
                END;
                    START TRANSACTION;
                        UPDATE log_usuario SET desactivar = 1 WHERE fkUsuario = id;
                        UPDATE usuario SET activo = 0 WHERE idUsuario = id;

                        SELECT * FROM usuario WHERE idUsuario = id;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS eliminar_usuario_fisico;
CREATE PROCEDURE eliminar_usuario_fisico(IN id INT)
                BEGIN
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;
                    START TRANSACTION;
                        DELETE FROM log_usuario WHERE fkUsuario = id;
                        DELETE FROM usuario WHERE idUsuario = id;
                        SELECT * FROM usuario WHERE idUsuario = id;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS insertar_producto;
CREATE PROCEDURE insertar_producto(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jFkCategoria INT;
                    DECLARE jFkProveedor INT;
                    DECLARE jnombre VARCHAR(50);
                    DECLARE jCosto DECIMAL(10,2);
                    DECLARE jPrecio DECIMAL(10,2);
                    DECLARE jSku VARCHAR(20);
                    DECLARE jImagen VARCHAR(50);
                    DECLARE jActivo TINYINT;
                    DECLARE jServicio TINYINT;
                    DECLARE _idProducto INT;

                    DECLARE _proveedor VARCHAR(50);
                    DECLARE _cantidad INT;

                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jFkCategoria = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.categoria'));
                    SET jFkProveedor = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.proveedor'));
                    SET jNombre = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.nombre'));
                    SET jCosto = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.costo'));
                    SET jPrecio = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.precio'));
                    SET jImagen = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.imagen'));
                    SET jActivo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.activo'));
                    SET jServicio = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.servicio'));

                    SELECT nombre INTO _proveedor FROM proveedor WHERE idProveedor = jFkProveedor;

                    SELECT COUNT(*) INTO _cantidad FROM producto INNER JOIN proveedor p on producto.fkProveedor = p.idProveedor WHERE idProveedor = jFkProveedor;

                    SET jSku = CONCAT(LEFT(_proveedor,3),'-', LEFT(jnombre,3),'-',(100 + _cantidad));

                    START TRANSACTION;
                        INSERT INTO producto VALUES (0, jFkCategoria, jFkProveedor, jNombre, jCosto, jPrecio, jSku, jImagen, jActivo, jServicio);
                        SELECT idProducto INTO _idProducto FROM producto WHERE nombre = jNombre LIMIT 1;
                        INSERT INTO log_producto VALUES (0, _idProducto, NOW(), NULL, NULL);
                        SELECT idLog FROM log_producto WHERE fkProducto = _idProducto LIMIT 1;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS obtener_productos;
CREATE PROCEDURE obtener_productos(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jIdSucursal JSON;
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jIdSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sucursal'));
                    START TRANSACTION ;
                        SELECT idProducto, producto.nombre, e.cantidad, sku, imagen,  TRUNCATE ((precio + (precio * ri.iva)), 2) AS TOTAL FROM producto
                            JOIN existencia e on producto.idProducto = e.fkProducto
                            JOIN sucursal s on e.fkSucursal = s.idSucursal
                            JOIN region_iva ri on s.fkRegion = ri.idRegion WHERE fkSucursal = jIdSucursal;
                    COMMIT ;
                END //

DROP PROCEDURE IF EXISTS obtener_busqueda;
CREATE PROCEDURE obtener_busqueda(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jIdSucursal JSON;
                    DECLARE busqueda VARCHAR(50);
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jIdSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sucursal'));
                    SET busqueda = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.busqueda'));
                    SET busqueda = CONCAT('%', busqueda, '%');
                    START TRANSACTION ;
                        SELECT idProducto, producto.nombre, e.cantidad, sku, imagen,  TRUNCATE ((precio + (precio * ri.iva)), 2) AS TOTAL FROM producto
                            JOIN existencia e on producto.idProducto = e.fkProducto
                            JOIN sucursal s on e.fkSucursal = s.idSucursal
                            JOIN region_iva ri on s.fkRegion = ri.idRegion WHERE fkSucursal = jIdSucursal AND (producto.nombre LIKE busqueda OR sku LIKE busqueda);
                    COMMIT ;
                END //

DROP PROCEDURE IF EXISTS obtener_busqueda;
CREATE PROCEDURE obtener_busqueda(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jIdSucursal JSON;
                    DECLARE busqueda VARCHAR(50);
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jIdSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sucursal'));
                    SET busqueda = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.busqueda'));
                    SET busqueda = CONCAT('%', busqueda, '%');
                    START TRANSACTION ;
                        SELECT idProducto, producto.nombre, e.cantidad, sku, imagen,  TRUNCATE ((precio + (precio * ri.iva)), 2) AS TOTAL FROM producto
                            JOIN existencia e on producto.idProducto = e.fkProducto
                            JOIN sucursal s on e.fkSucursal = s.idSucursal
                            JOIN region_iva ri on s.fkRegion = ri.idRegion WHERE fkSucursal = jIdSucursal AND (producto.nombre LIKE busqueda OR sku LIKE busqueda);
                    COMMIT ;
                END //
DROP PROCEDURE IF EXISTS obtener_filtro;
CREATE PROCEDURE obtener_filtro(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jIdSucursal JSON;
                    DECLARE categoria VARCHAR(50);
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jIdSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sucursal'));
                    SET categoria = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.categoria'));

                    START TRANSACTION ;
                        SELECT idProducto, producto.nombre, e.cantidad, sku, imagen,  TRUNCATE ((precio + (precio * ri.iva)), 2) AS TOTAL FROM producto
                            JOIN existencia e on producto.idProducto = e.fkProducto
                            JOIN sucursal s on e.fkSucursal = s.idSucursal
                            JOIN region_iva ri on s.fkRegion = ri.idRegion WHERE fkSucursal = jIdSucursal AND fkCategoria = categoria;
                    COMMIT ;
                END //


# CALL realizar_venta('[{"fkUsuario":"3","fkPunto":"1","fkTipoPago":"3","productos":[{"sku":"Bar-Pap-100","cantidad":5},{"sku":"Bar-Pap-102","cantidad":2},{"sku":"Coc-Cha-100","cantidad":10}]}]');
# CALL obtener_productos('[{"sucursal":1}]');

DROP PROCEDURE IF EXISTS realizar_venta;
CREATE PROCEDURE realizar_venta(IN _jsonA JSON)
BEGIN
    DECLARE _json JSON;
    DECLARE _productosJson JSON;
    DECLARE _sku VARCHAR(20);
    DECLARE _cantidad INT;
    DECLARE _contador INT DEFAULT 0;
    DECLARE _index INT DEFAULT 0;
    DECLARE _fkUsuario INT;
    DECLARE _fkPunto INT;
    DECLARE _fkTipoPago INT;
    DECLARE _idVenta INT;
    DECLARE _total DECIMAL(12,2);
    DECLARE _subTotal DECIMAL(12,2);
    DECLARE _iva DECIMAL(5,2);

    DECLARE _fkProducto INT;
    DECLARE _isr DECIMAL(5,2);
    DECLARE _ieps DECIMAL(5,2);

    DECLARE exit handler for sqlexception
    BEGIN
        SELECT 'Hubo un error';
        ROLLBACK;
    END;

    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
    SET _productosJson = JSON_EXTRACT(_json, '$.productos');

    SET _fkUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkUsuario'));
    SET _fkPunto = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkPunto'));
    SET _fkTipoPago = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkTipoPago'));

    SET _contador = JSON_DEPTH(_productosJson) - 1;
    SET _total = 0;

    START TRANSACTION;
        SELECT iva INTO _iva FROM sucursal INNER JOIN punto_venta on sucursal.idSucursal = punto_venta.fkSucursal INNER JOIN region_iva ri on sucursal.fkRegion = ri.idRegion WHERE idPunto = _fkPunto;

        INSERT INTO venta VALUES(0,_fkUsuario,_fkTipoPago,_total,NOW());

        WHILE _contador >= 0 DO
            SET _contador = _contador - 1;
            SET _json = JSON_EXTRACT(_productosJson, CONCAT('$[',_index,']'));
            SET _index = _index + 1;

            SET _sku = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sku'));
            SET _cantidad = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.cantidad'));

            SELECT SUM(_cantidad * precio) INTO _subTotal FROM producto JOIN existencia ON producto.idProducto = existencia.fkProducto WHERE sku = _sku;
            SELECT idVenta into _idVenta FROM venta WHERE fkUsuario = _fkUsuario && fkTipoPago = _fkTipoPago && fecha = NOW() && total = _total;

            SET _total = _total + _subTotal;

            SELECT idProducto INTO _fkProducto FROM producto WHERE sku = _sku;

            SELECT ieps INTO _ieps FROM categoria INNER JOIN producto p on categoria.idCategoria = p.fkCategoria WHERE idProducto = _fkProducto;
            SELECT isr INTO _isr FROM categoria INNER JOIN producto p on categoria.idCategoria = p.fkCategoria WHERE idProducto = _fkProducto;

            INSERT INTO info_venta VALUES (0,_fkProducto, _idVenta, _cantidad, _iva, _ieps, _isr, _subtotal);
            UPDATE existencia SET cantidad = cantidad - _cantidad WHERE fkProducto = _fkProducto;
        END WHILE;

            UPDATE venta SET total = _total WHERE idVenta = _idVenta;
    COMMIT;
END //

DELIMITER //
DROP PROCEDURE IF EXISTS obtener_detalles_compra;
CREATE PROCEDURE obtener_detalles_compra(IN _idVenta INT)
BEGIN
    SELECT u.usuario, venta.fecha, p.nombre, iv.subtotal ,venta.total FROM venta
    INNER JOIN usuario u on venta.fkUsuario = u.idUsuario
    INNER JOIN info_venta iv on venta.idVenta = iv.fkVenta
    INNER JOIN producto p on iv.fkProducto = p.idProducto
    WHERE _idVenta = idVenta;
END //

DELIMITER //
DROP PROCEDURE IF EXISTS generar_factura;
CREATE PROCEDURE generar_factura(IN _jsonA JSON)
BEGIN
    DECLARE _json          JSON;
    DECLARE _fkVenta       INT;
    DECLARE _fkRegimen     INT;
    DECLARE _rfc           VARCHAR(13);
    DECLARE _cp_persona    VARCHAR(10);
    DECLARE _nombre        VARCHAR(50);
    DECLARE _apellidoP     VARCHAR(50);
    DECLARE _apellidoM     VARCHAR(50);
    DECLARE _correo        VARCHAR(50);

    DECLARE exit handler for sqlexception
    BEGIN
        -- ERROR
        ROLLBACK;
    END;
    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
    SET _fkVenta = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkVenta'));
    SET _fkRegimen = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkRegimen'));
    SET _rfc = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.rfc'));
    SET _cp_persona = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.cp_persona'));
    SET _nombre = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.nombre'));
    SET _apellidoP = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoP'));
    SET _apellidoM = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoM'));
    SET _correo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.correo'));

    START TRANSACTION;
        INSERT INTO datos_factura VALUES (0,_fkVenta,_fkRegimen,_rfc,_cp_persona,_nombre,_apellidoP,_apellidoM,_correo);
    COMMIT;
END //

DELIMITER //
DROP PROCEDURE IF EXISTS generar_devolucion;
CREATE PROCEDURE generar_devolucion(IN _jsonA JSON)
BEGIN

    DECLARE _json JSON;
    DECLARE _date VARCHAR(10);
    DECLARE _idVenta INT;
    DECLARE _usuario VARCHAR(50);
    DECLARE _password VARCHAR(128);
    DECLARE _fkVenta INT;
    DECLARE _fkUsuario INT;

    DECLARE exit handler for sqlexception
    BEGIN
        -- ERROR
        ROLLBACK;
    END;

    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
    SET _date = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.date'));
    SET _idVenta = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.idVenta'));
    SET _usuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.usuario'));
    SET _password = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.password'));
    SET _fkVenta = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkVenta'));
    SET _fkUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkUsuario'));

    START TRANSACTION;
        IF (SELECT COUNT(*) FROM usuario WHERE usuario = _usuario and password = SHA2(_password,512)) = 1
            THEN
                SELECT idUsuario INTO _fkUsuario FROM usuario WHERE usuario = _usuario and password = SHA2(_password,512);
                SELECT idVenta INTO _fkVenta FROM venta WHERE DATE(fecha) = DATE(_date) AND fkUsuario = _fkUsuario;
                DELETE FROM info_venta WHERE fkVenta = _fkVenta;
                DELETE FROM venta WHERE DATE(fecha) = DATE(_date) AND fkUsuario = _fkUsuario;
                SELECT 'Devolución autorizada' as 'Status';
            ELSE
                SELECT 'Devolución no autorizada' as 'Status';
        END IF;
    COMMIT;
END //

DELIMITER //
DROP PROCEDURE IF EXISTS obtener_puntos_venta;
CREATE PROCEDURE obtener_puntos_venta(IN _jsonA JSON)
    BEGIN
       DECLARE _json JSON;
       DECLARE _idUsuario INT;

       SET _json = JSON_EXTRACT(_jsonA, '$[0]');
       SET _idUsuario = JSON_UNQUOTE(JSON_EXTRACT(_jsonA, '$.idUsuario'));

       SELECT idPunto, nombre FROM punto_venta WHERE fkUsuario = _idUsuario;
    END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS obtener_sucursal;
CREATE PROCEDURE obtener_sucursal(IN _jsonA JSON)
    BEGIN
       DECLARE _json JSON;
       DECLARE _idUsuario INT;
       DECLARE _puntoVenta INT;

       SET _json = JSON_EXTRACT(_jsonA, '$[0]');
       SET _idUsuario = JSON_UNQUOTE(JSON_EXTRACT(_jsonA, '$.idUsuario'));
       SET _puntoVenta = JSON_UNQUOTE(JSON_EXTRACT(_jsonA, '$.puntoVenta'));

       SELECT fkSucursal FROM punto_venta WHERE fkUsuario = _idUsuario AND idPunto = _puntoVenta;
    END //
DELIMITER ;

# ==============================================================
# |    LLENADO DE DATOS PREDETERMINADOS DE LA BASE DE DATOS    |
# ==============================================================

INSERT INTO permisos VALUES
                    (0, 1, 1, 1, 1), # SUPER-ADMIN
                    (0, 1, 0, 0, 1), # ADMIN
                    (0, 0, 0, 0, 1)  # USER
                    ;

INSERT INTO tipo VALUES
                    (0, 1, 'SUPER-ADMIN'),
                    (0, 2, 'ADMIN'),
                    (0, 3, 'USER')
                    ;

CALL insertar_usuario('{"nombre":"Nombre1","apellidoP":"ApellidoP1","apellidoM":"ApellidoM1","usuario":"super-admin","password":"123","correo":"a@a.com","telefono":"1234567890","rol":"1"}');
CALL insertar_usuario('{"nombre":"Nombre2","apellidoP":"ApellidoP2","apellidoM":"ApellidoM2","usuario":"admin","password":"456","correo":"a@a.com","telefono":"1234567890","rol":"2"}');
CALL insertar_usuario('{"nombre":"Nombre3","apellidoP":"ApellidoP3","apellidoM":"ApellidoM3","usuario":"user","password":"789","correo":"a@a.com","telefono":"1234567890","rol":"3"}');
CALL insertar_usuario('{"nombre":"Nombre3","apellidoP":"ApellidoP3","apellidoM":"ApellidoM3","usuario":"torybolla","password":"123","correo":"a@a.com","telefono":"1234567890","rol":"3"}');

INSERT INTO categoria VALUES (0, 'Abarrotes', 'Conjunto de artículos comerciales, especialmente comidas, bebidas y conservas', 0, 0.0, 0.0),
                             (0, 'Bebidas alc. -14°', 'Bebidas que contienen etanol en su composición', 1, 0.265, 0.0),
                             (0, 'Bebidas alc. 14°-20°', 'Bebidas que contienen etanol en su composición', 1, 0.3, 0.0),
                             (0, 'Bebidas alc. +20°', 'Bebidas que contienen etanol en su composición', 1, 0.53, 0.0);

INSERT INTO proveedor VALUES (0, 'Coca-Cola', '1234567890', 'coca@cola.mx'),
                             (0, 'Barcel', '0987654321', 'barcel@bimbo.mx'),
                             (0, 'Modelo', '5432109876', 'modelo@cervecera.mx'),
                             (0, 'Vinomex SA de CV', '6789012345', 'contacto@vinomex.mx');

CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Jalapeño 350g","costo":"18.0","precio":"22.0","imagen":"jalapeño.jpg" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Fuego 150g","costo":"12.0","precio":"15.0","imagen":"papas.png" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Saladas 150g","costo":"12.0","precio":"15.0","imagen":"papas.png" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"1","nombre":"Chaparrita Piña 255ml","costo":"15.0","precio":"18.0","imagen":"chaparrita.jpg" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"2","proveedor":"3","nombre":"Modelo Clara 355ml","costo":"12.0","precio":"25.0","imagen":"modeloClara.png" ,"activo":"1","servicio":"0"}');

SELECT * FROM producto;

INSERT INTO pais VALUES (0, 'Mexico');

INSERT INTO ciudad VALUES (0, 1, 'Cuernavaca'),
                          (0, 1, 'Emiliano Zapata'),
                          (0, 1, 'Temixco'),
                          (0, 1, 'Tijuana');

INSERT INTO region_iva VALUES (0, 1, 0.16),
                              (0, 1, 0.16),
                              (0, 1, 0.16),
                              (0, 4, 0.08);

INSERT INTO sucursal VALUES (0, 1, 1, 'Sucursal Cuernavaca', 'Degollado', 'Centro', '12345', '1234567890'),
                            (0, 2, 1, 'Sucursal Emiliano Zapata', 'Lazaro Cardenas', 'Las granjas', '67890', '1234567890'),
                            (0, 3, 1, 'Sucursal Temixco', 'Calz. Guadalupe', 'Lomas de Guadalupe', '56723', '1234567890'),
                            (0, 4, 1, 'Sucursal Tijuana', 'Av. Negrete', 'Miguel Negrete', '09821', '1234567890');

INSERT INTO existencia VALUES (0, 1, 1, 15),
                              (0, 4, 1, 22),
                              (0, 1, 2, 5),
                              (0, 4, 2, 25),
                              (0, 1, 3, 15),
                              (0, 2, 3, 7),
                              (0, 1, 4, 17),
                              (0, 4, 4, 27),
                              (0, 2, 4, 10),
                              (0, 3, 1, 10);

INSERT INTO tipo_pago VALUES (0,'Credito'),(0,'Debito'),(0,'Efectivo');

INSERT INTO punto_venta VALUES (0, 1, 3, 'Mesa 1'),
                               (0, 1, 3, 'Mesa 2'),
                               (0, 1, NULL, 'Mesa 3'),
                               (0, 1, NULL, 'Mesa 4');


# DESCOMENTAR EN CASO DE NO TENER NADA EN EL CARRITO, SE USARA PARA FINES PRACTICOS.
# INSERT INTO  carrito VALUES (0,1,3,1,12);
# INSERT INTO  carrito VALUES (0,2,3,1,2);
# INSERT INTO  carrito VALUES (0,3,3,1,5);
# INSERT INTO  carrito VALUES (0,1,2,1,12);
# INSERT INTO  carrito VALUES (0,2,2,1,2);
# INSERT INTO  carrito VALUES (0,3,2,1,5);
# SELECT * FROM tipo_pago;

# SELECT * FROM carrito;
# CALL vender_carrito(3,1,3);
# SELECT * FROM venta;

# Esta query en realidad no se va a hacer igualando la entrada del campo sino que se debe poder encontrar un producto con una palabra sin terminar.
# Entonce si escribo en el buscador 'vod' me deben salir en los artículos todos los productos que en el nombre, la marca, categoría, sku puedan contener
# las tres letras 'vod' para encontrar 'vodka'.

#SELECT * FROM producto WHERE nombre REGEXP CONCAT('^',?);

# CALL generar_devolucion('2022-05-10',3,'user',789);
# SELECT * FROM venta;


# CALL generar_devolucion('2022-05-10',3,'user',789);
# CALL obtener_detalles_compra(2);
# SELECT * FROM carrito;
