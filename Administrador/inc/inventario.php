<div class="row" style="margin-top: 5px;font-size: 19px;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?recibos=true">Recibos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Inventario</li>
  </ol>
  </nav>
</div>

<div class="row-1">


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

</div>
<div class="row">
  <div class="card" style="width: 12rem;">
    <img src="../src/image/productos/papas.png" class="card-img-top" alt="...">
    <div class="card-body">
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mostrarDetalleProducto"><i class="fa fa-search-plus"></i></button>
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#actualizar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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
            <input type="text" class="form-control" id="nombreproducto" disabled>
          </div>
          <div class="mb-3">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="text" class="form-control" id="precio" disabled>
          </div>
          <div class="mb-3">
            <label for="categoria" class="col-form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria" disabled>
          </div>
          <div class="mb-3">
            <label for="existencia" class="col-form-label">En existencia</label>
            <input type="text" class="form-control" id="existencia">
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
        <h5 class="modal-title" id="staticBackdropLabel">¿Est&aacutes seguro que deseas editar el producto?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="alertEdicionSatisfactoria()" d data-bs-dismiss="modal">S&iacute</button>
      </div>
    </div>
  </div>
</div>