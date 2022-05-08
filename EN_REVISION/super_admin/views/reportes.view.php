<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body >
    <div class="container-fluid" >
    <?php require ("../services/views/header.php") ?>

      <div class="row" >
        <?php require ("../services/views/menu.php") ?>
        <div class="col" style="font-size: 20px;  margin-top: 10px;">
          Resumen
          <div class="btn-group" style="float: right; margin-left: 5px; margin-bottom: 2px;">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              Sucursal
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>
          <div class="row-1" style="margin-top: 10px;">
            <label class="toggle">
              <input type="checkbox">
              <span class="slider"></span>
            
              <!-- label element 👇 -->
              <span class="labels" data-on="Día" data-off="Mes"></span>
            </label>
            <input type="date" id="eligeFechareporte" name="eligeFechareporte" style="margin-left: 20px;float:right">
            <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;">Detalle de Ventas</button>
            <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;">Ventas por producto</button>
            <button type="button" class="btn btn-outline-dark" style="float: right;">Ventas por categoría</button>
          </div>
          <div class="row-1" style="margin-top: 30px;"></div>



          </div>
        </div>
      </div>
    </div>
  </body>
</html>