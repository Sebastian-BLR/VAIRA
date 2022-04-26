<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <script src="js/javascript.js"></script>
  </head>
  <body >
    <div class="container-fluid" >
        <?php include './header.php' ?>


        <div class="row" >
                <div class="col-2" style="height: 100vh; ">
                  <div class="sidenav">
                    <a href="recibosadministrador.html"><i class="fa fa-ticket"></i>Recibos</a>
                    <a href="reportesadministrador.html"><i class="fa fa-line-chart"></i>Reportes</a>
                    <a href="inventarioadministrador.html" style="background-color: #ff7e2f;"><i class="fa fa-archive"></i>Inventario</a>
                    <a href="configuracionadministrador.html"><i class="fa fa-cogs"></i>Configuración</a>
                    <a href="ayudaSoporteadministrador.html"><i class="fa fa-info-circle"></i>Ayuda y Soporte</a>
                                  </div>
                </div>
                <div class="col ">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-filter"></i>Filtrar</button>
                    <ul class="dropdown-menu">
                      <li><input type="checkbox" id="filtro1" name="filtro1">
                        <label for="filtro1">Menor precio</label></li>
                      <li><input type="checkbox" id="filtro2" name="filtro2">
                        <label for="filtro2">Mayor precio</label></li>
                      <li><input type="checkbox" id="filtro3" name="filtro3">
                        <label for="filtro3">Categoria</label></li>
                    </ul>
                  </div>
                  <button type="button" class="btn btn-outline-dark" style="float: right; margin-top: 10px;" data-bs-toggle="dropdown" aria-expanded="false"></i>Modificar</button>
                  <ul class="dropdown-menu">
                    <li><button style="border: none;"  data-bs-toggle="modal" data-bs-target="#agregarUnProducto">Agregar un producto</button></li>
                    <li><button style="border: none;"  data-bs-toggle="modal" data-bs-target="#agregarVariosProductos">Agregar productos</button></li>
                  </ul>
                  <div class="wrapper">
                    <div class="row" style="margin: 0 0 5px 0;">
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/papas.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin: 0 0 5px 0;">
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/cheetos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/cheetos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/cheetos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/cheetos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/cheetos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin: 0 0 5px 0;">
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/jalapeño.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/jalapeño.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/jalapeño.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/jalapeño.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/jalapeño.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin: 0 0 5px 0;">
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/chaparrita.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/chaparrita.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/chaparrita.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/chaparrita.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                      <div class="card" style="width: 12rem;">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                        <img src="imagenes/chaparrita.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
                        </div>
                      </div>
                    </div>
                </div>
        </div>
      </div>

      <!-- Modal Detalle Producto-->
<div class="modal fade bd-example-modal-sm" id="mostrarDetalleProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalle de Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="vendedor" class="col-form-label">Nombre de producto</label>
            <input type="text" readonly class="form-control" id="nombreproducto">
          </div>
          <div class="mb-3">
            <label for="hora" class="col-form-label">Precio</label>
            <input type="text" readonly class="form-control" id="precio">
          </div>
          <div class="mb-3">
            <label for="productos" class="col-form-label">Categoria</label>
            <input type="text" readonly class="form-control" id="categoria">
          </div>
          <div class="mb-3">
            <label for="total" class="col-form-label">En existencia</label>
            <input type="text" readonly class="form-control" id="existencia">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar un producto-->
<div class="modal fade bd-example-modal-sm" id="agregarUnProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar un  producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="producto" class="col-form-label">Nombre de producto</label>
            <input type="text" class="form-control" id="nombreproducto">
          </div>
          <div class="mb-3">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="text" class="form-control" id="precio">
          </div>
          <div class="mb-3">
            <label for="categoria" class="col-form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria">
          </div>
          <div class="mb-3">
            <label for="existencia" class="col-form-label">En existencia</label>
            <input type="text" class="form-control" id="existencia">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar varios productos-->
<div class="modal fade bd-example-modal-sm" id="agregarVariosProductos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar varios productos al inventario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>