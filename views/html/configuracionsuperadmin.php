<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
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
                    <a href="recibossuperadmin.html"><i class="fa fa-ticket"></i>Recibos</a>
                    <a href="reportessuperadmin.html"><i class="fa fa-line-chart"></i>Reportes</a>
                    <a href="inventariosuperadmin.html"><i class="fa fa-archive"></i>Inventario</a>
                    <a href="configuracionsuperadmin.html" style="background-color: #e65d08"><i class="fa fa-cogs"></i>Configuración</a>
                    <a href="ayudaSoportesuperadmin.html"><i class="fa fa-info-circle"></i>Ayuda y Soporte</a>
                  </div>
                </div>
                <div class="col" style="font-size: 20px;  margin-top: 10px;">
                  <div class="row" style="font-size: 25px;  margin-top: 15px;">
                    <div class="col">
                      Usuarios
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal" data-bs-target="#agregarUsuario"></i>Agregar usuario</button> 
                    </div>
                  </div>
                  <div class="row-1" style="margin-top: 15px; font-size: 17px;">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nombre</th>
                          <th scope="col">Correo</th>
                          <th scope="col">Usuario</th>
                          <th scope="col">Contraseña</th>
                          <th scope="col">Rol</th>
                          <th scope="col">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">administrador1</th>
                          <td>admin1@gmail.com</td>
                          <td>administrador 1</td>
                          <td>******</td>
                          <td>administrador</td>
                          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()" style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <tr>
                          <th scope="row">vendedor1</th>
                          <td>vendedor1@gmail.com</td>
                          <td>vendedor 1</td>
                          <td>********</td>
                          <td>vendedor</td>
                          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"  style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <tr>
                          <th scope="row">administrador2</th>
                          <td>admin2@gmail.com</td>
                          <td>administrador 2</td>
                          <td>*********</td>
                          <td>administrador</td>
                          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"  style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
                      </tbody>
                    </table>
                    <div class="row-1" style="margin-top: 15px;font-size: 25px;">
                      Respaldo
                      <div class="row-1" style="margin-top: 8px;font-size: 17px;">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th scope="row">Fecha de Respaldo</th>
                              <td><input type="date" id="eligeFechaRespaldo" name="eligeFechaRespaldo"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="row-1" style="margin-top: 15px;font-size: 25px;">
                        Cambiar contraseña
                        <div class="row-1" style="margin-top: 8px;font-size: 17px;">
                          <table class="table">
                            <tbody>
                              <tr>
                                <th scope="row">Contraseña actual</th>
                                <td><input type="password" id="contraseñaActual" name="contraseñaActual"></td>
                              </tr>
                              <tr>
                                <th scope="row">Nueva contraseña</th>
                                <td><input type="password" id="contraseñaNueva" name="contraseñaNueva"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
      </div>
  <!-- Modal Agregar Usuario-->
<div class="modal fade bd-example-modal-xl" id="agregarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="rfc" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Correo:</label>
            <input type="email" class="form-control" id="correo">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario">
          </div>
          <div class="mb-3">
            <label for="codigopostal" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contraseña">
          </div>
          <div class="mb-3">
            <label for="regimenfiscal" class="col-form-label">Rol:</label>
            <select name="rol" id="rol" form="carform">
              <option value="opcionadmin">Administrador</option>
              <option value="opcionvendedor">Vendedor</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="alertAgregarUsuario()">Agregar</button>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>