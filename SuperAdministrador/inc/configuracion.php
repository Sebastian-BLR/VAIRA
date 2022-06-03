    
      
<div style="font-size: 20px;  margin-top: 10px;">
  <div class="row" style="font-size: 25px;  margin-top: 15px;">
    <div class="col">
      Usuarios
    </div>
    <div class="col">
      <button type="button" class="btn btn-outline-dark" style="float: right; margin-left:5px" data-bs-toggle="modal"
        data-bs-target="#agregarProveedor"></i>Agregar proveedor</button>
      <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal"
        data-bs-target="#agregarUsuario"></i>Agregar usuario</button>
    </div>
  </div>
</div>
<div class="row-1" style="margin-top: 15px; font-size: 17px;">
  <div class="wrapper"  style="height:33vh;">
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
          <th scope="row">administrador1</th>
          <td>admin1@gmail.com</td>
          <td>administrador 1</td>
          <td>******</td>
          <td>administrador</td>
          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
          <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario">
            <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
        </tr>
        <tr>
          <th scope="row">vendedor1</th>
          <td>vendedor1@gmail.com</td>
          <td>vendedor 1</td>
          <td>********</td>
          <td>vendedor</td>
          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
          <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario">
            <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
        </tr>
        <tr>
          <th scope="row">administrador2</th>
          <td>admin2@gmail.com</td>
          <td>administrador 2</td>
          <td>*********</td>
          <td>administrador</td>
          <td><button type="button" class="btn btn-danger" onclick="alertElimarUsuario()"
              style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
          <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario">
            <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row-1" style="margin-top: 5px; font-size: 25px;">
  <div class="col">
    Proveedores
  </div>
</div>
<div class="row-1" style="margin-top: 15px; font-size: 17px;">
    <div class="wrapper"  style="height:30vh;">   
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>administrador 1</td>
            <td>1234567890</td>
            <td>admin1@gmail.com</td>
            <td><button type="button" class="btn btn-danger" onclick="alertElimarProveedor()"
                style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
            <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarProveedor">
              <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
          </tr>
          <td>administrador 2</td>
            <td>1234567890</td>
            <td>admin2@gmail.com</td>
            <td><button type="button" class="btn btn-danger" onclick="alertElimarProveedor()"
                style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
            <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarProveedor">
              <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
          </tr>
          <td>administrador 3</td>
            <td>1234567890</td>
            <td>admin3@gmail.com</td>
            <td><button type="button" class="btn btn-danger" onclick="alertElimarProveedor()"
                style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
            <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarProveedor">
              <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
          </tr>
        </tbody>
      </table>
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
                  <label for="password2" class="col-form-label">Confirmar contraseña:</label>
                  <input type="password2" class="form-control" id="contrasena">
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
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
          onclick="alertAgregarUsuario()">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar Proveedor-->
<div class="modal fade bd-example-modal-xl" id="agregarProveedor" data-bs-backdrop="static"
  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="rfc" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" id="usuario">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Correo:</label>
            <input type="email" class="form-control" id="correo">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
          onclick="alertAgregarProveedor()">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Editar Usuario-->
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
            <input type="text" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Apellido paterno:</label>
            <input type="text" class="form-control" id="apellidoP">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Apellido materno:</label>
            <input type="text" class="form-control" id="apellidoM">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Rol:</label>
            <input type="text" class="form-control" id="rol">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Correo:</label>
            <input type="text" class="form-control" id="correo">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" id="telefono">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Contraseña:</label>
            <input type="text" class="form-control" id="contrasena">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Confirmar Contraseña:</label>
            <input type="text" class="form-control" id="contrasena">
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="alertEditarUsuario()">Editar</button>
      </div>
    </div>
  </div>
</div>

<!-- Editar Proveedor-->
<div class="modal fade bd-example-modal-xl" id="editarProveedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" id="telefono">
        </div>
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Correo:</label>
            <input type="text" class="form-control" id="correo">
        </div>        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="alertEditarProveedor()">Editar</button>
      </div>
    </div>
  </div>
</div>