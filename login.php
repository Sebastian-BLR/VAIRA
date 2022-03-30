<?php session_start();

require "functions.php";

if(isset($_SESSION['user'])){
    // header("Location: index.php");
}

$errores = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // * GET data from form and store in variables
    $usuario = filter_var( strtolower( $_POST['usuario']) , FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    echo "User: $usuario - Pass: $password";

    try {
        $conexion = connect();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $statement = $conexion->prepare(
        'SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password'
    );

    $result = $statement->execute(array(
        ':usuario' => $usuario,
        ':password' => $password
    ));

    $result = $statement->fetch();

    if($result !== false){
        $_SESSION['user'] = $usuario;
        // header("Location: index.php");
    } else {
        $errores .= '<li>Datos incorrectos</li>';
    }

}

?>