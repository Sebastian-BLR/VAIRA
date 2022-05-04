USE db_vaira;

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
                    DECLARE jActivo TINYINT;
                    DECLARE jServicio TINYINT;
                    DECLARE _idProducto INT;
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
                    SET jSku = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.sku'));
                    SET jActivo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.activo'));
                    SET jServicio = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.servicio'));

                    START TRANSACTION;
                        INSERT INTO producto VALUES (0, jFkCategoria, jFkProveedor, jNombre, jCosto, jPrecio, jSku, NULL, jActivo, jServicio);
                        SELECT idProducto INTO _idProducto FROM producto WHERE nombre = jNombre LIMIT 1;
                        INSERT INTO log_producto VALUES (0, _idProducto, NOW(), NULL, NULL);
                        SELECT idLog FROM log_producto WHERE fkProducto = _idProducto LIMIT 1;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS agregar_producto_carrito;
CREATE PROCEDURE agregar_producto_carrito(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jFkProducto INT;
                    DECLARE jFkUsuario INT;
                    DECLARE jFkPunto INT;
                    DECLARE jCantidad INT;
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jFkProducto = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.producto'));
                    SET jFkUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.usuario'));
                    SET jFkPunto = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.punto'));
                    SET jCantidad = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.cantidad'));

                    IF( (SELECT cantidad FROM existencia WHERE fkProducto = jFkProducto AND fkSucursal = (SELECT DISTINCT fkSucursal FROM punto_venta WHERE fkUsuario = jFkUsuario) > 0) OR
                        (SELECT cantidad - jCantidad FROM existencia WHERE fkProducto = jFkProducto AND fkSucursal = (SELECT DISTINCT fkSucursal FROM punto_venta WHERE fkUsuario = jFkUsuario)) < 0)
                    THEN
                        START TRANSACTION;
                            INSERT INTO carrito VALUES (0, jFkProducto, jFkUsuario, jFkPunto, jCantidad);
                            UPDATE existencia SET cantidad = cantidad - jCantidad WHERE fkProducto = jFkProducto AND fkSucursal = (SELECT DISTINCT fkSucursal FROM punto_venta WHERE fkUsuario = jFkUsuario);
                            SELECT * FROM existencia WHERE fkProducto = jFkProducto LIMIT 1;
                        COMMIT ;
                    ELSE
                        SELECT 'No hay items suficientes en inventario' AS 'RESULTADO';
                        ROLLBACK ;
                    END IF;

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
                        SELECT idProducto, producto.nombre, e.cantidad, sku, imagen,  (precio + (precio * ri.iva)) AS TOTAL FROM producto
                            JOIN existencia e on producto.idProducto = e.fkProducto
                            JOIN sucursal s on e.fkSucursal = s.idSucursal
                            JOIN region_iva ri on s.fkRegion = ri.idRegion WHERE fkSucursal = jIdSucursal;
                    COMMIT ;
                END //

DROP PROCEDURE IF EXISTS obtener_carrito;
CREATE PROCEDURE obtener_carrito(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE jFkUsuario INT;
                    DECLARE jFkPunto INT;
                    DECLARE exit handler for sqlexception
                    BEGIN
                        -- ERROR
                        ROLLBACK;
                    END;
                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET jFkUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.usuario'));
                    SET jFkPunto = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.punto'));


                    START TRANSACTION ;
                        # la tercera query sería obtener el carrito de compras con respecto del vendedor (punto de venta) e inicio de sesión del usuario
                        SELECT * FROM carrito INNER JOIN producto p on carrito.fkProducto = p.idProducto WHERE fkUsuario = jFkUsuario && fkPunto = jFkPunto;
                    COMMIT ;
                END //
DELIMITER ;

CALL insertar_usuario('{"nombre":"Nombre1","apellidoP":"ApellidoP1","apellidoM":"ApellidoM1","usuario":"super-admin","password":"123","correo":"a@a.com","telefono":"1234567890","rol":"1"}');
CALL insertar_usuario('{"nombre":"Nombre2","apellidoP":"ApellidoP2","apellidoM":"ApellidoM2","usuario":"admin","password":"456","correo":"a@a.com","telefono":"1234567890","rol":"2"}');
CALL insertar_usuario('{"nombre":"Nombre3","apellidoP":"ApellidoP3","apellidoM":"ApellidoM3","usuario":"user","password":"789","correo":"a@a.com","telefono":"1234567890","rol":"3"}');

INSERT INTO categoria VALUES (0, 'Abarrotes', 'Conjunto de artículos comerciales, especialmente comidas, bebidas y conservas', 0, 0.0, 0.0),
                             (0, 'Bebidas alc. -14°', 'Bebidas que contienen etanol en su composición', 1, 0.265, 0.0),
                             (0, 'Bebidas alc. 14°-20°', 'Bebidas que contienen etanol en su composición', 1, 0.3, 0.0),
                             (0, 'Bebidas alc. +20°', 'Bebidas que contienen etanol en su composición', 1, 0.53, 0.0);

INSERT INTO proveedor VALUES (0, 'Coca-Cola', '1234567890', 'coca@cola.mx'),
                             (0, 'Barcel', '0987654321', 'barcel@bimbo.mx'),
                             (0, 'Modelo', '5432109876', 'modelo@cervecera.mx'),
                             (0, 'Vinomex SA de CV', '6789012345', 'contacto@vinomex.mx');


CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Jalapeño 350g","costo":"18.0","precio":"22.0","sku":"PAP-JAL-350","activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Fuego 150g","costo":"12.0","precio":"15.0","sku":"PAP-FUE-150G","activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"1","nombre":"Chaparrita Piña 255ml","costo":"15.0","precio":"18.0","sku":"CHA-PIÑ-350G","activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"2","proveedor":"3","nombre":"Modelo Clara 355ml","costo":"12.0","precio":"25.0","sku":"CER-CLA-355ML","activo":"1","servicio":"0"}');

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
                              (0, 2, 4, 10);

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

DELIMITER //
DROP PROCEDURE IF EXISTS vender_carrito;
CREATE PROCEDURE vender_carrito(IN _fkUsuario INT, IN _fkPunto INT, IN _fkTipoPago INT)
BEGIN
    DECLARE _idVenta INT;
    DECLARE _total DECIMAL(12,2);
    DECLARE _iva DECIMAL(5,2);

    DECLARE exit handler for sqlexception
    BEGIN
        SELECT 'Hubo un error';
        ROLLBACK;
    END;

    START TRANSACTION;
        IF ((SELECT COUNT(*) FROM carrito WHERE fkUsuario = _fkUsuario && fkPunto = _fkPunto) > 0)
        THEN
            SELECT SUM(cantidad * precio) INTO _total FROM carrito INNER JOIN producto p on carrito.fkProducto = p.idProducto WHERE fkUsuario = _fkUsuario && fkPunto = _fkPunto;
            INSERT INTO venta VALUES (0,_fkUsuario,_fkTipoPago,_total,NOW());
            SELECT idVenta into _idVenta FROM venta WHERE fkUsuario = _fkUsuario && fkTipoPago = _fkTipoPago && fecha = NOW() && total = _total;
            SELECT iva INTO _iva FROM sucursal INNER JOIN punto_venta on sucursal.idSucursal = punto_venta.fkSucursal INNER JOIN region_iva ri on sucursal.fkRegion = ri.idRegion WHERE idPunto = _fkPunto;

            INSERT INTO info_venta(fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal)
            SELECT idProducto, _idVenta, cantidad, _iva, ieps, isr, (cantidad * (precio + (precio * _iva)))
            FROM carrito INNER JOIN producto p on carrito.fkProducto = p.idProducto INNER JOIN categoria c on p.fkCategoria = c.idCategoria WHERE fkUsuario = _fkUsuario && fkPunto = _fkPunto;

            DELETE FROM carrito WHERE fkUsuario = _fkUsuario && fkPunto = _fkPunto;
            COMMIT;
        ELSE
            SELECT 'El carrito está vacio' as 'Resultado';
            ROLLBACK;
        END IF;
END //

# Esta query en realidad no se va a hacer igualando la entrada del campo sino que se debe poder encontrar un producto con una palabra sin terminar.
# Entonce si escribo en el buscador 'vod' me deben salir en los artículos todos los productos que en el nombre, la marca, categoría, sku puedan contener
# las tres letras 'vod' para encontrar 'vodka'.

#SELECT * FROM producto WHERE nombre REGEXP CONCAT('^',?);