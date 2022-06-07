-- ================================ --
-- |  Created on Wed May 25 2022  | --
-- |   Copyright (c) 2022 VAIRA   | --
-- |     All Rights Reserved.     | --
-- ================================ --
-- |  Código encargado de llenar  | --
-- |   la base de datos durante   | --
-- |    la fase de desarrollo     | --
-- ================================ --

USE db_vaira;

INSERT INTO permisos VALUES
                    (0, 1, 1, 1, 1), # SUPER-ADMIN
                    (0, 1, 0, 0, 1), # ADMIN
                    (0, 0, 0, 0, 1)  # USER
                    ;

INSERT INTO tipo VALUES
                    (0, 1, 'SUPER-ADMIN'),
                    (0, 2, 'ADMIN'),
                    (0, 3, 'VENDEDOR')
                    ;

INSERT INTO pais VALUES (0, 'Mexico');

INSERT INTO ciudad VALUES (0, 1, 'Cuernavaca'),
                          (0, 1, 'Emiliano Zapata'),
                          (0, 1, 'Temixco'),
                          (0, 1, 'Tijuana');

INSERT INTO region_iva VALUES (0, 1, 0.16),
                              (0, 1, 0.16),
                              (0, 1, 0.16),
                              (0, 4, 0.08);

INSERT INTO motivo_egreso VALUES (0, 'Compra producto'),
                                 (0, 'Devolucion');

INSERT INTO sucursal VALUES (0, 1, NULL, 'Cuernavaca', 'Degollado', 'Centro', '12345', '1234567890');


# CALL generar_devolucion('[{"fecha":"2022-05-23 16:01:17","idVenta":3,"usuario":"admin","password":456,"fkUsuario":3,"restaurar":1,"fkSucursal":1}]');

# CALL filtrar_ventas('[{"fkUsuario":3,"fecha":"2022-05-22","fkSucursal":1,"rango":1}]');
# CALL filtrar_ventas('[{"fkUsuario":3,"fecha":"2022-05-22","fkSucursal":1,"rango":2}]');
# CALL filtrar_ventas('[{"fkUsuario":3,"fecha":"2022-05-22","fkSucursal":1,"rango":3}]');
# CALL filtrar_ventas('[{"fkUsuario":3,"fecha":"2022-05-22","fkSucursal":1,"rango":4}]');

CALL filtrar_ventas_mensuales('[{"fkUsuario":3,"fkSucursal":1}]');

CALL filtrar_ventas_semanal('[{"fkUsuario":1,"fkSucursal":1,"fecha":"2022-05-22"}]');
CALL filtrar_ventas_categoria('[{"fkUsuario":2,"fkSucursal":1,"fecha":"2022-05-22","rango":3}]');
CALL filtrar_ventas_producto('[{"fkUsuario":2,"fkSucursal":1,"fecha":"2022-05-22","rango":1}]');

CALL insertar_usuario('{"nombre":"Nombre1","apellidoP":"ApellidoP1","apellidoM":"ApellidoM1","usuario":"super-admin","password":"123","correo":"a@a.com","telefono":"1234567890","rol":"1"}');
CALL insertar_usuario('{"nombre":"Nombre2","apellidoP":"ApellidoP2","apellidoM":"ApellidoM2","usuario":"admin","password":"456","correo":"a@a.com","telefono":"1234567890","rol":"2", "sucursal":1}');
CALL insertar_usuario('{"nombre":"Nombre3","apellidoP":"ApellidoP3","apellidoM":"ApellidoM3","usuario":"user","password":"789","correo":"a@a.com","telefono":"1234567890","rol":"3", "sucursal":1}');

UPDATE sucursal SET fkAdmin = 2 WHERE idSucursal = 1;

INSERT INTO categoria VALUES (0, 'Abarrotes', 'Conjunto de artículos comerciales, especialmente comidas, bebidas y conservas', 0, 0.0, 0.0),
                             (0, 'Bebidas alc. -14°', 'Bebidas que contienen etanol en su composición', 1, 0.265, 0.0),
                             (0, 'Bebidas alc. 14°-20°', 'Bebidas que contienen etanol en su composición', 1, 0.3, 0.0),
                             (0, 'Bebidas alc. +20°', 'Bebidas que contienen etanol en su composición', 1, 0.53, 0.0);

INSERT INTO proveedor VALUES (0, 'Coca-Cola', '1234567890', 'coca@cola.mx', 1),
                             (0, 'Barcel', '0987654321', 'barcel@bimbo.mx', 1),
                             (0, 'Modelo', '5432109876', 'modelo@cervecera.mx', 1),
                             (0, 'Vinomex SA de CV', '6789012345', 'contacto@vinomex.mx', 1);

CALL insertar_producto('{"categoria":"1","proveedor":"1","nombre":"Chaparrita Piña 255ml","costo":"15.0","precio":"18.0","imagen":"chaparrita.jpg" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Jalapeño 350g","costo":"18.0","precio":"22.0","imagen":"jalapeño.jpg" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Fuego 150g","costo":"12.0","precio":"15.0","imagen":"papas.png" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"1","proveedor":"2","nombre":"Papas Saladas 150g","costo":"12.0","precio":"15.0","imagen":"papas.png" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"2","proveedor":"3","nombre":"Modelo Clara 355ml","costo":"12.0","precio":"25.0","imagen":"modeloClara.png" ,"activo":"1","servicio":"0"}');
CALL insertar_producto('{"categoria":"4","proveedor":"4","nombre":"Absolute Vodka 1.5L","costo":"366.50","precio":"425.58","imagen":"vodka.png" ,"activo":"1","servicio":"0"}');

# INSERT INTO existencia VALUES (1, 1, 15),
#                               (4, 1, 22),
#                               (3, 1, 10),
#                               (6, 1, 15);


INSERT INTO tipo_pago VALUES (0,'Tarjeta de credito'),
                             (0,'Tarjeta de debito'),
                             (0,'Efectivo');

INSERT INTO punto_venta VALUES (0, 1, 3, 'Mesa 1'),
                               (0, 1, 3, 'Mesa 2'),
                               (0, 1, NULL, 'Mesa 3'),
                               (0, 1, NULL, 'Mesa 4');

INSERT INTO regimen_fiscal VALUES (0, 'Régimen Simplificado de Confianza'),
                                  (0, 'Sueldos y salarios e ingresos asimilados a salarios'),
                                  (0, 'Régimen de Actividades Empresariales y Profesionales'),
                                  (0, 'Régimen de Incorporación Fiscal'),
                                  (0, 'Enajenación de bienes'),
                                  (0, 'Régimen de Actividades Empresariales con ingresos a través de Plataformas Tecnológicas'),
                                  (0, 'Régimen de Arrendamiento'),
                                  (0, 'Intereses'),
                                  (0, 'Obtención de premios'),
                                  (0, 'Dividendos'),
                                  (0, 'Demás ingresos');

INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (1, 3, 3, 1, 76.56, '2022-05-22 14:19:48');
INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (2, 3, 3, 1, 514.55, '2022-05-22 16:53:38');
INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (3, 3, 3, 1, 191.40, '2022-05-23 16:01:17');
INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (4, 3, 3, 1, 153.12, '2022-05-24 13:04:13');

# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (5, 3, 3, 1, 76.56, NOW());
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (6, 3, 3, 1, 514.55, NOW());
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (7, 3, 3, 1, 191.40, NOW());
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (8, 3, 3, 1, 153.12, NOW());
#
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (9, 3, 3, 1, 76.56, '2022-07-22 14:19:48');
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (10, 3, 3, 1, 514.55, '2022-06-22 16:53:38');
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (11, 3, 3, 1, 191.40, '2022-06-23 16:01:17');
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (12, 3, 3, 1, 153.12, '2022-07-24 13:04:13');
# INSERT INTO venta (idVenta, fkUsuario, fkTipoPago, fkSucursal, total, fecha) VALUES (13, 3, 3, 1, 153.12, '2022-08-24 13:04:13');

INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (1, 1, 1, 2, 0.16, 0.00, 0.00, 41.76);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (2, 3, 1, 2, 0.16, 0.00, 0.00, 34.80);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (3, 6, 2, 1, 0.16, 0.53, 0.00, 493.67);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (4, 1, 2, 1, 0.16, 0.00, 0.00, 20.88);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (5, 4, 3, 10, 0.16, 0.00, 0.00, 174.00);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (6, 3, 3, 1, 0.16, 0.00, 0.00, 17.40);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (7, 4, 4, 3, 0.16, 0.00, 0.00, 52.20);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (8, 1, 4, 4, 0.16, 0.00, 0.00, 83.52);
INSERT INTO info_venta (idInfo, fkProducto, fkVenta, cantidad, iva, ieps, isr, subtotal) VALUES (9, 3, 4, 1, 0.16, 0.00, 0.00, 17.40);