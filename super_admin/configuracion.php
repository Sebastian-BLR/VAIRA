<?php session_start();
    if (!isset($_SESSION['user']) || $_SESSION['userType'] != 1)
        header("Location: ../login.php");
        
    require '../services/connection.php';
    require '../services/functions_usuarios.php';

    $errores = '';
    $enviado = '';
    $eliminado = '';

    // ! ====================================================
    // !                OBTENCION DE USUARIOS              //
    // ! ====================================================
    
    $statement = $connection->prepare(
        'SELECT idUsuario, nombre, correo, usuario, tipo, activo FROM persona JOIN usuario ON fkUsuario = usuario.idUsuario JOIN tipo ON fkTipo = tipo.idTipo;'
    );
    $statement->execute();
    $usuarios = $statement->fetchAll();
    
    
    // ! ====================================================
    // !                OBTENCION DE TIPOS                 //
    // ! ====================================================

    $statement = $connection->prepare("SELECT * FROM tipo");
    $statement->execute();
    $tipos = $statement->fetchAll(PDO::FETCH_ASSOC);

    // ! ====================================================
    // !                REGISTRO DE USUARIOS               //
    // ! ====================================================
    
    if(isset($_POST["agregar"])){
        $resultado = registrar_usuario($_POST, $connection);
        
        if($resultado === true)
            $enviado = true; 
        else
            $errores = $resultado;
    }

    // ! ====================================================
    // !                ELIMINAR USUARIOS                  //
    // ! ====================================================

    if(isset($_GET["id"])){
        $resultado = eliminar_usuario($_GET["id"], $connection);
        if($resultado)
            $eliminado = true;
    }

    require 'views/configuracion.view.php';
?>