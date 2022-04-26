<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Vendedor</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilos.css">
    
  </head>
  <body >
    <div class="container-fluid" >
        <?php include './header.php' ?>

        <div class="row" >
          <div class="col-2" style="height: 90vh; ">
            <?php 
              $user_type = 'vendedor';
              include './sidenavbar.php' 
            ?>
          </div>
          <div class="col ">
            <?php
              if (isset($_GET['nueva_venta'])){
                include './vendedor_inc/nueva_venta.php';
              }else if (isset($_GET['recibos'])){
                include './vendedor_inc/recibos.php';
              }else if (isset($_GET['reportes'])){
                include './vendedor_inc/reportes.php';
              }else if (isset($_GET['ayuda_y_soporte'])){
                include './vendedor_inc/ayuda_y_soporte.php';
              }
            ?>
          </div>
        </div>
    </div>
  </body>
</html>