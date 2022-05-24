<div class="row" style="margin-top: 5px;font-size: 19px;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?recibos=true">Recibos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Configuraci&oacuten</li>
  </ol>
  </nav>
</div>
<div class="row" style="font-size: 25px; margin-top: 15px;">
  <div>
    Usuarios
    <button type="button" class="btn btn-outline-dark" style="float: right; margin-left:5px" data-bs-toggle="modal" data-bs-target="#configImpuestos"></i>Configurar impuestos</button>
    <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal" data-bs-target="#agregarUsuario"></i>Agregar usuario</button> 
  </div>
</div>
<div class="row" style="margin-top: 15px; font-size: 17px;">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Usuario</th>
        <th scope="col">Contraseña</th>
        <th scope="col">Rol</th>
        <th scope="col">Eliminar</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">vendedor1</th>
        <td>vendedor1@gmail.com</td>
        <td>vendedor1</td>
        <td>******</td>
        <td>vendedor</td>
        <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()" style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
        <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
      </tr>
      <tr>
        <th scope="row">vendedor2</th>
        <td>vendedor2@gmail.com</td>
        <td>vendedor 2</td>
        <td>********</td>
        <td>vendedor</td>
        <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"  style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
        <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
      </tr>
      <tr>
        <th scope="row">vendedorPablo</th>
        <td>pablovende@gmail.com</td>
        <td>vendedor Pablo</td>
        <td>*********</td>
        <td>vendedor</td>
        <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"  style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
        <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
    </tbody>
  </table>
</div>
<div class="row" style="margin-top: 15px; font-size: 25px;">
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
</div>
<div class="row" style="margin-top: 15px; font-size: 25px;">

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
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="apellidoP" class="col-form-label">Apellido paterno:</label>
            <input type="text" class="form-control" id="apellidoP">
          </div>
          <div class="mb-3">
            <label for="apellidoM" class="col-form-label">Apellido materno:</label>
            <input type="text" class="form-control" id="apellidoM">
          </div>
          <div class="mb-3">
            <label for="usuario" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario">
          </div>
          <div class="mb-3">
            <label for="correo" class="col-form-label">Correo:</label>
            <input type="email" class="form-control" id="correo">
          </div>
          <div class="mb-3">
            <label for="telefono" class="col-form-label">Tel&eacutefono:</label>
            <input type="text" class="form-control" id="teleforno">
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena">
          </div>
          <div class="mb-3">
            <label for="rol" class="col-form-label">Rol:</label>
            <select name="rol" id="rol">
              <option value="volvo">Vendedor</option>
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

<!-- Modal Configuración de impuestos-->
<div class="modal fade bd-example-modal-xl" id="configImpuestos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Configuración de impuestos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="hora" class="col-form-label">Selecciona la región</label>
            <br>
            <div class="btn-group">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Región
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Tijuana</a></li>
                  <li><a class="dropdown-item" href="#">CDMX</a></li>
                  <li><a class="dropdown-item" href="#">Sinaloa</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="hora" class="col-form-label">Selecciona IVA</label>
            <br>
            <div class="btn-group">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  IVA
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">8%</a></li>
                  <li><a class="dropdown-item" href="#">16%</a></li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="alertConfigImpuesto()">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Usuario-->
<div class="modal fade bd-example-modal-xl" id="editarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" disabled>
          </div>
          <div class="mb-3">
            <label for="apellidoP" class="col-form-label">Apellido paterno:</label>
            <input type="text" class="form-control" id="apellidoP" disabled>
          </div>
          <div class="mb-3">
            <label for="apellidoM" class="col-form-label">Apellido materno:</label>
            <input type="text" class="form-control" id="apellidoM" disabled>
          </div>
          <div class="mb-3">
            <label for="usuario" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" disabled>
          </div>
          <div class="mb-3">
            <label for="rol" class="col-form-label">Rol:</label>
            <input type="text" class="form-control" id="rol" disabled>
          </div>
          <div class="mb-3">
            <label for="correo" class="col-form-label">Correo:</label>
            <input type="email" class="form-control" id="correo">
          </div>
          <div class="mb-3">
            <label for="telefono" class="col-form-label">Tel&eacutefono:</label>
            <input type="text" class="form-control" id="teleforno">
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena">
          </div>
          <div class="btn-group">
            <label for="puntodeventa" class="col-form-label">Punto de venta:</label>
            <button type="button" class="btn btn-outline-secondary" style="margin-left: 5px;" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-arrow-down"></i></button>
            <ul class="dropdown-menu">
              <li><input type="checkbox" id="punto1" name="punto2">
                <label for="filtro1">Mesa 1</label></li>
              <li><input type="checkbox" id="punto2" name="punto2">
                <label for="filtro2">Mesa 2</label></li>
              <li><input type="checkbox" id="punto3" name="punto3">
                <label for="filtro3">Mesa 3</label></li>
            </ul>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#confirmarEditar">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirmación editar -->
<div class="modal fade bd-example-modal-sm" id="confirmarEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">¿Est&aacutes seguro que deseas editar el usuario?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-dismiss="modal"  onclick="alertEdicionSatisfactoriaUsuario()">S&iacute</button>
      </div>
    </div>
  </div>
</div>