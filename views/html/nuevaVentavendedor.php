<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilos.css">
 
  </head>
  <body >
    <div class="container-fluid" >
        <?php include './header.php' ?>


        <div class="row" >
                <div class="col-2" style="height: 100vh; ">
                  <?php include './sidenavbar.php' ?>

                </div>
                <div class="col ">
                  <button type="button" class="btn btn-secondary"><i class="fa fa-filter"></i>Filtrar</button>
                  <div class="wrapper">
                    <div class="row" >
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nombre de producto</h5>
                          <a href="#" class="btn btn-primary">Agregar a carrito</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  Carrito de Compra
                  <br>
                  <div class="btn-group">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Punto de venta
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">1</a></li>
                        <li><a class="dropdown-item" href="#">2</a></li>
                        <li><a class="dropdown-item" href="#">3</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
        </div>
      </div>
  </body>
</html>