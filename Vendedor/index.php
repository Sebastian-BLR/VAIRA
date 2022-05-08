
<?php
  session_start();
  if( !isset($_SESSION['user']) )
    header("Location: ../index.php");

  include '../services/helper.php';

  $id_usuario = $_SESSION['idUsuario'];
  $user_type = $_SESSION['userType'];
  $id_punto_de_venta = 2;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == "true"){
      $data = [
        "producto" => trim($_POST["id_producto"]),
        "usuario" => $id_usuario,
        "punto" => $id_punto_de_venta,
        "cantidad" => trim($_POST["cantidad"])
      ];
      $result = json_decode(Post("services/addToCart.php",$data), true);
      unset($_POST['add_to_cart']);
    }
   

  }

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
    <title>Vendedor</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    
  </head>
  <body >
    <div class="container-fluid" >
        <?php include 'inc/header.php' ?>

        <div class="row" >
          <div class="col-2" style="height: 90vh; ">
            <?php 
              $user_type = 'vendedor';
              include 'inc/sidenavbar.php' 
            ?>
          </div>
          <div class="col ">
            <?php
              if (isset($_GET['nueva_venta'])){
                include 'inc/nueva_venta.php';
              }else if (isset($_GET['recibos'])){
                include 'inc/recibos.php';
              }else if (isset($_GET['reportes'])){
                include 'inc/reportes.php';
              }else if (isset($_GET['ayuda_y_soporte'])){
                include 'inc/ayuda_y_soporte.php';
              }
            ?>
          </div>
        </div>
    </div>

  </body>
</html>