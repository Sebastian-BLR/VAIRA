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

SELECT * FROM tipo;

INSERT INTO tipo VALUES
                    (0, 1, 'SUPER-ADMIN'),
                    (0, 2, 'ADMIN'),
                    (0, 3, 'USER')
                    ;

SELECT * FROM usuario;

INSERT INTO usuario VALUES
                    (0, 1, 'superAdmin', SHA2('123', 512)),
                    (0, 2, 'admin', SHA2('456', 512)),
                    (0, 3, 'user', SHA2('789', 512))
                    ;
