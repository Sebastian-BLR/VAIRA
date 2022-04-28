<?php

function registrar_usuario($datos, $connection){
    $errores = '';
    // * GET data from form and store in variables
    
    $nombre = filter_var ($_POST['nombre'], FILTER_SANITIZE_STRING);
    $apellidoP = filter_var ($_POST['apellidoP'], FILTER_SANITIZE_STRING);
    $apellidoM = filter_var ($_POST['apellidoM'], FILTER_SANITIZE_STRING);
    $usuario = filter_var ($_POST['usuario'], FILTER_SANITIZE_STRING);

    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    $correo = filter_var ($_POST['correo'] , FILTER_SANITIZE_EMAIL);
    $telefono = filter_var( $_POST['telefono'] , FILTER_SANITIZE_STRING);
    $rol = filter_var( $_POST['rol'] , FILTER_SANITIZE_STRING );

    if(empty($nombre) or empty($apellidoP) or empty($apellidoM) or empty($usuario) or empty($password) or empty($password2) or empty($correo) or empty($telefono) or empty($rol)){
        $errores .= '<li>Por favor rellena todos los campos</li>';
    } else {
        if(!$connection)
            die();

        $statement = $connection->prepare('SELECT * FROM usuario WHERE usuario = :usuario LIMIT 1');
        $statement->execute(array(':usuario' => $usuario));
        $resultado = $statement->fetch();

        if($resultado != false){
            $errores .= '<li>El nombre de usuario ya existe</li>';
        }

        if($password != $password2){
            $errores .= '<li>Las contraseñas no coinciden</li>';
        }

    }

    if($errores == ''){
        $obj = (object)array();
        $obj->nombre = $nombre;
        $obj->apellidoP = $apellidoP;
        $obj->apellidoM = $apellidoM;
        $obj->usuario = $usuario;
        $obj->password = $password;
        $obj->correo = $correo;
        $obj->telefono = $telefono;
        $obj->rol = $rol;
        
        $myJSON = json_encode($obj);
        // var_dump($myJSON);

        $statement = $connection->prepare('CALL insertar_usuario(:myJSON)');
        $resultado = $statement->execute(array(':myJSON' => $myJSON));
        return $resultado;

    }
    return $errores;
}

function eliminar_usuario($id, $connection){
    $id = $_GET["id"];
    $statement = $connection->prepare('CALL eliminar_usuario(:id)');
    $resultado = $statement->execute(array(':id' => $id));
    return $resultado;
}

?>