<?php
    include './services/login.php';
?>

<!doctype html>
<html lang="en">
  <head>
   <!-- Evita reenviar el formulario cuando se recarga la página-->
   <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <script src="Vendedor/js/jsVendedor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">

  </head>

  <body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="src/image/vaira.png" alt="logo" />
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Iniciar sesi&oacute;n</h4>


                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                                <div class="form-group">
                                    <label for="user"><i class="fa fa-fw fa-user"></i>Usuario</label>
                                    <input id="user" type="text" class="form-control"  name="user" value="" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="fa fa-fw fa-key"></i>Contrase&ntilde;a</label>
                                    <input id="password" type="password" class="form-control" name="password"  minlength="8" required data-eye>
                                    <input type="checkbox" onclick="myFunction()"> Mostrar contraseña
                                </div>    
                                <div class="form-group m-0" >
                                    <button type="submit" class="btn btn-outline-purple btn-block"> Login </button>
                                </div>
                                <input hidden type="text" name="login" value="true" >
                                <?php
                                    echo($errores);
                                ?>
                               
                            </form>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
