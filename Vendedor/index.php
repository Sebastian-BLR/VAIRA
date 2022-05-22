<?php
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['userType'] != 3)
    header("Location: ../index.php");

  include '../services/helper.php';
  include '../services/connection.php';

  $id_usuario = $_SESSION['user'];
  $user_type = $_SESSION['userType'];
  
  $data = [
    "idUsuario" => $id_usuario,
  ];
  $id_punto_de_venta = json_decode(POST("Vendedor/services/getPuntosVenta.php",$data), true);
  $categorias = json_decode(POST("Vendedor/services/getCategories.php",$data), true);
  
  if(!isset($_SESSION['id_punto_de_venta'])){
    $_SESSION['id_punto_de_venta'] = $id_punto_de_venta[0][0]; //  ! DECLARAMOS EL ID DEL PUNTO DE VENTA DEFAULT
  }

  
  $data = [
    "idUsuario" => $id_usuario,
    "puntoVenta" => trim($_SESSION['id_punto_de_venta'])
  ];

  $sucursal = json_decode(POST("Vendedor/services/getSucursal.php",$data), true);
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['punto_de_venta'])){
      $_SESSION['id_punto_de_venta'] = $_POST['punto_de_venta'];
      unset($_POST['punto_de_venta']);

    }

    if(isset($_POST['categoria'])){
      $_SESSION['filtro'] = $_POST['categoria'];
    }
    
    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == "true"){
      if(!isset($_SESSION['cart'][$_SESSION['id_punto_de_venta']]))
        $_SESSION['cart'][$_SESSION['id_punto_de_venta']] = [];

      $do_exist = false;
      foreach ($_SESSION["cart"][$_SESSION['id_punto_de_venta']] as $clave => $valor){
        if($valor["id_producto"] == $_POST['id_producto']){
          $_SESSION["cart"][$_SESSION['id_punto_de_venta']][$clave]["cantidad"]++;
          $do_exist = true;
        }
      }
      if(!$do_exist){
        array_push($_SESSION['cart'][$_SESSION['id_punto_de_venta']], 
          array(
            "id_producto"=>$_POST['id_producto'],
            "nombre_producto"=>$_POST['nombre_producto'],
            "cantidad"=>$_POST['cantidad'],
            "precio_unitario"=>$_POST['precio_unitario'],
            "sku_producto"=>$_POST['sku_producto']
          )
        );
      }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/jsVendedor.js"></script>


    
  </head>
  <body >
    <div class="container-fluid" >
        <?php include 'inc/header.php' ?>

        <div class="row" >
          <div class="col-2" style="height: 83vh; ">
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
        <?php  include 'inc/footer.php'; ?>
    </div>

  </body>
</html>