<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">

    <script src="js/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body >
    <div class="container-fluid" >
      <?php require ("../services/views/header.php") ?>
      <div class="row" >
        <?php require ("../services/views/menu.php") ?>
        <div class="col" style="font-size: 20px;  margin-top: 10px;">
          <div class="row" style="font-size: 25px;  margin-top: 15px;">
            <div class="col">
              Usuarios
            </div>
            <div class="col">
              <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal"
              data-bs-target="#agregarUsuario"></i>Agregar usuario</button>
            </div>
          </div>
          <div class="row-1" style="margin-top: 15px; font-size: 17px;">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
              <td><?php echo $usuario['nombre'] ?></td>
              <td><?php echo $usuario['correo'] ?></td>
              <td><?php echo $usuario['usuario'] ?></td>
              <td><?php echo $usuario['tipo'] ?></td>
              <td><?php 
                      if($usuario['activo'] == 1) 
                        echo 'Activo';
                      else
                        echo 'Inactivo';
                  ?></td>
              <td>
              <!--                                                                                    onclick="alertEliminarUsuario(this.id)" -->
                  <button type="button" class="btn btn-danger" id=<?php echo $usuario['idUsuario'] ?> onclick="alertEliminarUsuario(this.id)" style="float: center;" name="eliminar"><i class="fa fa-minus-circle"></i></button>
              </td>
            </tr>
            <?php endforeach; ?>
            <!-- <tr>
              <th scope="row">administrador1</th>
              <td>admin1@gmail.com</td>
              <td>administrador 1</td>
              <td>******</td>
              <td>administrador</td>
              <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
            </tr>
            <tr>
              <th scope="row">vendedor1</th>
              <td>vendedor1@gmail.com</td>
              <td>vendedor 1</td>
              <td>********</td>
              <td>vendedor</td>
              <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
            </tr>
            <tr>
              <th scope="row">administrador2</th>
              <td>admin2@gmail.com</td>
              <td>administrador 2</td>
              <td>*********</td>
              <td>administrador</td>
              <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td> -->
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
      <div class="modal fade bd-example-modal-xl" id="agregarUsuario" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="registro-modal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col mb-1">
                      <label for="nombre" class="col-form-label">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col mb-1">
                      <label for="apellidoP" class="col-form-label">Apellido Paterno</label>
                      <input type="text" class="form-control" id="apellidoP" name="apellidoP" required>
                    </div>
                    <div class="col mb-1">
                      <label for="apellidoM" class="col-form-label">Apellido Materno</label>
                      <input type="text" class="form-control" id="apellidoM" name="apellidoM" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-1">
                      <label for="correo" class="col-form-label">Correo</label>
                      <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-1">
                      <label for="usuario" class="col-form-label">Usuario</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-1">
                      <label for="password" class="col-form-label">Contraseña</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col mb-1">
                      <label for="password2" class="col-form-label">Confirma la contraseña</label>
                      <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-1">
                      <label for="telefono" class="col-form-label">Telefono</label>
                      <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-1">
                      <label for="rol" class="col-form-label">Rol:</label>
                      <select name="rol" id="rol" form="registro-modal">
                        <?php foreach($tipos as $tipo): ?>
                          <option value="<?php echo $tipo['idTipo']; ?>"><?php echo strtolower( $tipo['tipo']); ?></option>
                        <?php endforeach; ?>
                          <!-- <option value="opcionadmin">Administrador</option>
                          <option value="opcionvendedor">Vendedor</option> -->
                      </select>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" onclick="alertAgregarUsuario()" name="agregar"> Agregar </button>
              </div>
              <?php if(!empty($errores)): ?>
                <?php 
                echo "<script>Swal.fire({
                  title: 'Error',
                  html: '$errores',
                  icon: 'error',
                    confirmButtonText: 'Ok'
                  }).then((result)=>{
                    if(result.isConfirmed){
                      window.location.href='configuracion.php';
                    }
                  }) </script>";
                  ?>
              <?php elseif($enviado): ?>
                <?php 
                echo "<script>Swal.fire({
                  title: 'Usuario agregado!',
                  icon: 'success',
                    confirmButtonText: 'Ok'
                  }).then((result)=>{
                    if(result.isConfirmed){
                      window.location.href='configuracion.php';
                    }
                  }) </script>";
                  ?>
              <?php elseif($eliminado): ?>
                <?php 
                  echo "<script>Swal.fire({
                    title: 'Usuario eliminado!',
                    icon: 'success',
                      confirmButtonText: 'Ok'
                    }).then((result)=>{
                      if(result.isConfirmed){
                        window.location.href='configuracion.php';
                      }
                    }) </script>";
                ?>
              <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
  </body>
  
  </html>