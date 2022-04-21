<?php session_start();
require "services/connection.php";

if(isset($_SESSION['user'])){
    switch($_SESSION['userType']) {
        case 1:
            header("Location: super_admin/index.php");
            break;
        case 2:
            header("Location: admin/index.php");
            break;
        case 3:
            header("Location: user/index.php");
            break;
    }
    // header("Location: index.php");
}

$errores = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // * GET data from form and store in variables
    $usuario = filter_var( $_POST['user'] , FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // echo "User: $usuario - Pass: $password";

    if(!$connection)
        die();

    $statement = $connection->prepare(
        'SELECT tipo.idTipo FROM usuario INNER JOIN tipo WHERE usuario.fkTipo = tipo.idTipo AND usuario = :usuario AND password = SHA2(:password,512)'
        // 'SELECT * FROM usuario WHERE usuario = :usuario AND password = SHA2(:password,512)'
        // 'SELECT * FROM usuario INNER JOIN tipo WHERE usuario.fkTipo = tipo.idTipo &&
    );

    $result = $statement->execute(array(
        ':usuario' => $usuario,
        ':password' => $password
    ));

    $result = $statement->fetch();

    if($result !== false){
        $_SESSION['user'] = $usuario;
        $userType = $result['idTipo'];
        $_SESSION['userType'] = $userType;

        // User types:
        // 1.- Super Admin
        // 2.- Admin
        // 3.- User
        switch($userType) {
            case 1:
                header("Location: super_admin/index.php");
                break;
            case 2:
                header("Location: admin/index.php");
                break;
            case 3:
                header("Location: user/index.php");
                break;
        }
    } else {
        $errores .= '<li>Datos incorrectos</li>';
    }

}

require "views/index_login.view.php";

// ! QUITAR EL DESTROY!!!
// session_destroy();
?>