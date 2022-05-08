<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="imagenes/vaira.png" alt="logo" />
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <!-- TODO: USAR CODIGOS HTML PARA ACENTOS -->
                            <h4 class="card-title">Iniciar sesi&oacute;n</h4>
                            <form method="POST" action="indexvendedor.html" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="email"><i class="fa fa-fw fa-user"></i>Usuario</label>
                                    <input id="email" type="text" class="form-control" name="email" value="" required autofocus maxlength="30">
                                </div>
    
                                <div class="form-group">
                                    <label for="password"><i class="fa fa-fw fa-key"></i>Contraseña
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                </div>    
                            
                                <div class="form-group m-0" >
                                    <button type="submit" class="btn btn-outline-purple btn-block" >
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>