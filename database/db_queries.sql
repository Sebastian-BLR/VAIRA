USE db_vaira;

SELECT  * FROM permisos;

# SUPER-ADMINISTRADOR
# ADMINISTRADOR
# USUARIO

INSERT INTO permisos VALUES
                    (0, 1, 1, 1, 1),
                    (0, 1, 0, 0, 1),
                    (0, 0, 0, 0, 1)
                    ;

INSERT INTO tipo VALUES
                    (0, 1, 'SUPER-ADMIN'),
                    (0, 2, 'ADMIN'),
                    (0, 3, 'USER')
                    ;

INSERT INTO usuario VALUES
                    (0, 1, 'superAdmin', SHA2('123', 512)),
                    (0, 2, 'admin', SHA2('456', 512)),
                    (0, 3, 'user', SHA2('789', 512))
                    ;

DROP PROCEDURE IF EXISTS insertar_usuario;

DELIMITER //

CREATE PROCEDURE insertar_usuario(IN _jsonA JSON)
                BEGIN
                    DECLARE _json JSON;
                    DECLARE fkTipo VARCHAR(10);
                    DECLARE nombre VARCHAR(50);
                    DECLARE apellidoP VARCHAR(50);
                    DECLARE apellidoM VARCHAR(50);
                    DECLARE correo VARCHAR(50);
                    DECLARE telefono VARCHAR(50);
                    DECLARE jUsuario VARCHAR(50);
                    DECLARE _password VARCHAR(50);
                    DECLARE fkUsuario INT;

                    SET _json = JSON_EXTRACT(_jsonA, '$[0]');
                    SET nombre = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.nombre'));
                    SET apellidoP = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoP'));
                    SET apellidoM = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.apellidoM'));
                    SET jUsuario = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.usuario'));
                    SET _password = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.password'));
                    SET correo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.correo'));
                    SET telefono = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.telefono'));
                    SET fkTipo = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.rol'));

                    START TRANSACTION;
                        INSERT INTO usuario VALUES (0, fkTipo, jUsuario, sha2(_password, 512));
                        SELECT idUsuario INTO fkUsuario FROM usuario WHERE usuario = jUsuario;
                        INSERT INTO persona VALUES (0, fkUsuario, nombre, apellidoP, apellidoM, correo, telefono);
                        SELECT * from persona WHERE nombre = @nombre;
                    COMMIT;
                END //

DROP PROCEDURE IF EXISTS eliminar_usuario;

CREATE PROCEDURE eliminar_usuario(IN id INT)
                BEGIN
                    START TRANSACTION;
                        DELETE FROM persona WHERE fkUsuario = id;
                        DELETE FROM log_usuario WHERE fkUsuario = id;
                        DELETE FROM usuario WHERE idUsuario = id;
                        SELECT * FROM usuario WHERE idUsuario = id;
                    COMMIT;
                END //

DELIMITER ;

CALL insertar_usuario('{"nombre":"Rodrigo Sebastian","apellidoP":"de la Rosa","apellidoM":"Andres","usuario":"roy22","password":"roy456","correo":"a@a.com","telefono":"1234567890","rol":"1"}');