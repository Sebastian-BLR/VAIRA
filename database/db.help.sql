USE db_vaira;
DELIMITER //
DROP PROCEDURE IF EXISTS h_filtrar_vsemanal_user;
CREATE PROCEDURE h_filtrar_vsemanal_user(IN _jsonA JSON, OUT _salida TEXT)
    BEGIN
        DECLARE _fkUsuario   INT;
        DECLARE _fkSucursal  INT;
        DECLARE _totalVentas INT;
        DECLARE _json        JSON;
        DECLARE _resultado   TEXT;
        DECLARE _tempJson    JSON;
        DECLARE _tempJson2   JSON;
        DECLARE _dayName     VARCHAR(50);
        DECLARE _fecha       DATE;
        DECLARE _dia         INT DEFAULT 1;

        DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            SELECT '¡Error!' as 'Resultado';
            ROLLBACK;
        END;

        SET _json       = JSON_EXTRACT(_jsonA, '$[0]');
        SET _fkUsuario  = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkUsuario' ));
        SET _fkSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkSucursal'));
        SET _fecha      = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fecha'));
        SET _dia        = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.dia'));

        START TRANSACTION;
            IF ((SELECT COUNT(*) FROM venta WHERE fkUsuario = _fkUsuario AND DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkSucursal = _fkSucursal) > 0) THEN
                SELECT COUNT(*) INTO _totalVentas FROM venta
                    WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkUsuario = _fkUsuario AND fkSucursal = _fkSucursal;
                SELECT JSON_OBJECT('Ventas',COUNT(*),'Total',IFNULL(SUM(total),0)) INTO _tempJson FROM venta
                    WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkUsuario = _fkUsuario AND fkSucursal = _fkSucursal;


                SELECT DAYNAME(fecha) INTO _dayName FROM venta WHERE fkUsuario = _fkUsuario AND fkSucursal = _fkSucursal AND DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) LIMIT 1;

                SELECT JSON_ARRAYAGG(JSON_OBJECT('idVenta',idVenta,'fkTipoPago',fkTipoPago,'total',total,'fecha',fecha)) as Resultado INTO _tempJson2 FROM venta
                WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkUsuario = _fkUsuario AND fkSucursal = _fkSucursal;

                SET _resultado = JSON_INSERT(_tempJson,'$.Detalles',_tempJson2);
            ELSE
                SET _resultado = 'Sin Registros';
            END IF;

            SET _salida = _resultado;
        COMMIT;
    END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS h_filtrar_vsemanal_admin;
CREATE PROCEDURE h_filtrar_vsemanal_admin(IN _jsonA JSON, OUT _salida TEXT)
    BEGIN
        DECLARE _fkSucursal  INT;
        DECLARE _totalVentas INT;
        DECLARE _json        JSON;
        DECLARE _resultado   TEXT;
        DECLARE _tempJson    JSON;
        DECLARE _tempJson2   JSON;
        DECLARE _fecha       DATE;
        DECLARE _dayName     VARCHAR(50);
        DECLARE _dia         INT DEFAULT 1;

        DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            SELECT '¡Error!' as 'Resultado';
            ROLLBACK;
        END;

        SET _json       = JSON_EXTRACT(_jsonA, '$[0]');
        SET _fkSucursal = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fkSucursal'));
        SET _dia        = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.dia'));
        SET _fecha      = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fecha'));

        START TRANSACTION;
            IF ((SELECT COUNT(*) FROM venta WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkSucursal = _fkSucursal) > 0) THEN
                SELECT COUNT(*) INTO _totalVentas FROM venta
                    WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkSucursal = _fkSucursal;

                SELECT JSON_OBJECT('Ventas',_totalVentas,'Total',SUM(total)) INTO _tempJson FROM venta
                    WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkSucursal = _fkSucursal;

                SELECT DAYNAME(fecha) INTO _dayName FROM venta WHERE fkSucursal = _fkSucursal AND DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) LIMIT 1;

                SELECT JSON_ARRAYAGG(JSON_OBJECT('fkUsuario',fkUsuario,'idVenta',idVenta,'fkTipoPago',fkTipoPago,'total',total,'fecha',fecha)) as Resultado INTO _tempJson2 FROM venta
                WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) AND fkSucursal = _fkSucursal;
#
                SET _resultado = JSON_INSERT(_tempJson,'$.Detalles',_tempJson2);
            ELSE
                SET _resultado = 'Sin Registros';
            END IF;

            SET _salida = _resultado;
        COMMIT;
    END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS h_filtrar_vsemanal_sadmin;
CREATE PROCEDURE h_filtrar_vsemanal_sadmin(IN _jsonA JSON, OUT _salida TEXT)
    BEGIN
        DECLARE _fkSucursal  INT;
        DECLARE _totalVentas INT;
        DECLARE _limit       INT;
        DECLARE _json        JSON;
        DECLARE _resultado   TEXT;
        DECLARE _tempResult  TEXT;
        DECLARE _tempJson    JSON;
        DECLARE _tempJson2   JSON;
        DECLARE _sucurName   TEXT;
        DECLARE _fecha       DATE;
        DECLARE _dayName     VARCHAR(50);
        DECLARE _dia         INT DEFAULT 1;
        DECLARE _index       INT DEFAULT 0;

        DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            SELECT '¡Error!' as 'Resultado';
            ROLLBACK;
        END;

        SET _json       = JSON_EXTRACT(_jsonA, '$[0]');
        SET _dia        = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.dia'));
        SET _fecha      = JSON_UNQUOTE(JSON_EXTRACT(_json, '$.fecha'));

        START TRANSACTION;
            IF ((SELECT COUNT(*) FROM venta WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha)) > 0) THEN
                SELECT COUNT(*) INTO _totalVentas FROM venta WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha);

                SELECT JSON_OBJECT('Ventas',_totalVentas,'Total',SUM(total)) INTO _tempJson FROM venta
                    WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha);

                SELECT DAYNAME(fecha) INTO _dayName FROM venta WHERE DAYOFWEEK(fecha) = _dia AND WEEK(fecha) = WEEK(_fecha) LIMIT 1;
                SET _resultado = JSON_INSERT(_tempJson,'$.Sacursal',JSON_ARRAY());

                SELECT JSON_ARRAYAGG(JSON_OBJECT('idSucursal',idSucursal)) INTO _tempJson2 FROM sucursal;
                SET _limit = JSON_LENGTH(_tempJson2);

                WHILE _index < _limit DO
                    SELECT JSON_EXTRACT(_tempJson2,CONCAT('$[',_index,'].idSucursal')) INTO _fkSucursal;
                    CALL h_filtrar_vsemanal_admin(JSON_ARRAY(JSON_OBJECT('fkSucursal',_fkSucursal,'dia',_dia,'fecha',_fecha)),@jsonResult);
                    SET _tempResult = @jsonResult;

                    SELECT nombre INTO _sucurName FROM sucursal WHERE idSucursal = _fkSucursal;

                    SET _resultado = JSON_INSERT(_resultado,CONCAT('$.Sacursal[',_index,']'),JSON_OBJECT(_fkSucursal,JSON_OBJECT('Nombre',_sucurName,'Detalles',CONVERT(_tempResult,JSON))));

                    SET _index = _index + 1;
                END WHILE;
            ELSE
                SET _resultado = 'Sin Registros';
            END IF;

            SET _salida = _resultado;
        COMMIT;
    END//
DELIMITER ;

CALL filtrar_ventas_semanal('[{"fkUsuario":1,"fkSucursal":1,"fecha":"2022-05-22"}]');

CALL h_filtrar_vsemanal_sadmin(JSON_ARRAY(JSON_OBJECT('dia',1,'fecha','2022-05-22')),@jsonResult);