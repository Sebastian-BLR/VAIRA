


               
                
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
<div class="btn-group">
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Sucursal
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Cuernavaca</a></li>
      <li><a class="dropdown-item" href="#">Temixco</a></li>
      <li><a class="dropdown-item" href="#">Xochitepec</a></li>
    </ul>
  </div>
</div>
<div class="wrapper">
  <div class="row" style="margin: 0 0 5px 0;">
    <div class="card" style="width: 12rem;">
      <div class="card-body">
        <button type="button" class="btn btn-outline-info" style="margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-outline-info" style="margin: -65px 0 0 120px;" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      </div>
      <img src="../src/image/productos/papas.png" class="card-img-top" alt="...">
      <div class="card-body">
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
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

<!-- Modal Actualizar producto-->
<div class="modal fade bd-example-modal-sm" id="actualizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar producto</h5>
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

<!-- Modal Eliminar producto-->
<div class="modal fade bd-example-modal-sm" id="eliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <h5 class="modal-title" id="staticBackdropLabel">Eliminar producto del inventario</h5>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
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
            <label for="formFile" class="form-label">Imagen producto</label>
            <input class="form-control" type="file" id="formFile">
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
            <label for="servicio" class="col-form-label">Es un servicio:</label>
            <select name="select servicio" onchange="cambiarVisibiidadExistencia()" id="select_servicio" form="carform">
              <option value="0">No</option>
              <option value="1">Sí</option>
            </select>
          </div>
          <div class="mb-3" id="existeniaDiv">
            <label for="existencia" class="col-form-label">En existencia</label>
            <input type="text" class="form-control" id="existencia">
          </div>
          <div class="mb-3">
            <label for="proveedor" class="col-form-label">Proveedor</label>
            <input type="text" class="form-control" id="proveedor">
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
<div class="modal fade bd-example-modal-lg" id="agregarVariosProductos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Validar conexión con lector de códigos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          Esperando conexión ...
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
  function cambiarVisibiidadExistencia(newStatus){
    var selectedValue = document.getElementById("select_servicio").value;
    // var newStatus = selectedValue ==1? "block":"none";
    // document.getElementById("existeniaDiv").style.display = newStatus;
    var newStatus = selectedValue ==1? "hidden":"visible";
    document.getElementById("existeniaDiv").style.visibility = newStatus;
  }
</script>

