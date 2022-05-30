<?php 
  require "../services/funciones.php";
?>

<div class="row" style="margin-top: 5px;font-size: 19px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?nueva_venta=true">Nueva venta</a></li>
      <li class="breadcrumb-item active" aria-current="page">Recibos</li>
    </ol>
    </nav>
</div>
<div class="row" style="font-size: 20px;  margin-top: 10px;">
    Recibos
    <div class="row" style="margin-top: 10px;">
      <div class="col">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']).'?recibos=true'?>" method="POST" style="display: inline;">
          <input type="date" id="eligeFecha" name="eligeFecha">
          <button type="submit" class="btn btn-primary fa fa-search" style="padding: 5px 12px; margin-top:-.8%;"></button>
        </form>
      </div>
      <div class="col">
        <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#corteCaja">Hacer corte de caja</button>
        <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal" data-bs-target="#hacerDevolucion">Hacer devoluci&oacute;n</button>
      </div>
    </div>
    <div class="row-1" style="margin-top: 30px;">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No.Venta</th>
            <th scope="col">Fecha</th>
            <th scope="col">Sucursal</th>
            <th scope="col">Monto</th>
            <th scope="col">Detalle</th>
            <th scope="col">Factura</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_POST['eligeFecha']) && $_POST['eligeFecha'] != "") {
            $data = [
              'idUsuario' => $id_usuario,
              'fecha' => $_POST['eligeFecha']
            ];
          
            $input_from_db = json_decode(POST("Vendedor/services/getSalesPerDate.php",$data), true);
            
          } else{ 
            $data = [
              'idUsuario' => $id_usuario
            ];
            $input_from_db = json_decode(POST("Vendedor/services/getSales.php",$data), true);
          }


          if ($input_from_db == null){
            echo('
              <tr>
                <th scope="row"></th>
                <td>No se encontraron recibos</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              ');
          } else{
            foreach($input_from_db as $value){
              //In between the pair of dots is supposed to be the variable $value andin brackets the specific value retrieved from the db
              // NOTE: each button below must have a 'name' or/and 'value' attribute added, the modal wont work if we dont pass anything specific from each item
              echo('
              <tr>
                <th scope="row">'.$value[0].'</th>
                <td>'.fecha($value[1]).'</td>
                <td>'.$value[2].'</td>
                <td>$'.$value[3].'</td>
                <td><button type="button" class="btn btn-outline-dark" style="float: center; margin-left: 15px;" data-bs-toggle="modal" data-bs-target="#mostrarDetalle'.$value[0].'"><i class="fa fa-search-plus"></i></button></td>
                <td><button type="button" class="btn btn-outline-dark" style="float: center; margin-left: 15px;" data-bs-toggle="modal" data-bs-target="#generaFactura"><i class="fa fa-book"></i></button></td>
              </tr>
              ');
           }
          ?>
        </tbody>
      </table>

    <!-- Modal Factura-->
    <div class="modal fade bd-example-modal-xl" id="generaFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Generar Factura</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- //* =========================================================================================== -->
            <!-- //*                 REALIZAR CONEXION CON EL SAT PARA REALIZAR UNA FACTURACION                  -->
            <!-- //* =========================================================================================== -->
            <!-- //*               MODIFICAR LAS PROPIEDADES DEL FORM PARA ESTABLECER LA CONEXION                -->
            <!-- //* =========================================================================================== -->
            <form>
              <div class="mb-3">
                <label for="rfc" class="col-form-label">Capture su RFC:</label>
                <input type="text" class="form-control" id="rfc" maxlength="13">
              </div>
              <div class="mb-3">
                <label for="nombre" class="col-form-label">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre">
              </div>
              <div class="mb-3">
                <label for="codigopostal" class="col-form-label">C&oacute;digo Postal:</label>
                <input type="text" class="form-control" id="codigopostal" maxlength="5" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
              </div>
              <div class="mb-3">
                <label for="regimenfiscal" class="col-form-label">Régimen Fiscal:</label>
                <select name="regimenFiscal" id="regimenFiscal" form="carform">
                  <?php
                    $input_from_db = json_decode(POST("Vendedor/services/getTaxRegimen.php",$data), true);

                    foreach($input_from_db as $value){
                      echo('
                      <option value="'.$value[0].'">'.$value[1].'</option>
                      ');
                    }
                  ?>
                </select>
                <div class="mb-3">
                  <label for="metodopago" class="col-form-label">M&eacute;todo de Pago:</label>
                  <select name="cars" id="cars" form="carform">
                  <?php
                    $input_from_db = json_decode(POST("Vendedor/services/getPaymentMethods.php",$data), true);

                    foreach($input_from_db as $value){
                      echo('
                      <option value="'.$value[0].'">'.$value[1].'</option>
                      ');
                    }
                  ?>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="alertFactura()" data-bs-dismiss="modal">Generar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Corte de Caja -->
    <div class="modal fade" id="corteCaja" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Corte de caja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          ¿Deseas realizar el corte de caja?
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" onclick="alertGeneraDocCorteCajaAdmin()" data-bs-dismiss="modal">Si</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hacer una devolución -->
    <div class="modal fade bd-example-modal-xl" id="hacerDevolucion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Devoluci&oacute;n</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="fechaCompra" class="col-form-label">Fecha de compra</label>
                <br>
                <input type="date" id="fechaDeCompra" name="fechaDeCompra">
              </div>
              <div class="mb-3">
                <label for="noCompra" class="col-form-label">N&uacute;mero de compra</label>
                <br>
                <input type="text" id="noCompra" name="noCompra">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#llaveAdmin" data-bs-dismiss="modal">Aceptar</button>
          </div>
        </div>
      </div>
    </div>

  
    <!-- Modal llave administrador-->
    <div class="modal fade" id="llaveAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Ingresar claves de acceso de administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="form-group">
              <label for="user"><i class="fa fa-fw fa-user"></i>Usuario</label>
              <input id="user" type="text" class="form-control"  name="user" value="">
          </div>
          <div class="form-group">
              <label for="password"><i class="fa fa-fw fa-key"></i>Contrase&ntilde;a</label>
              <input id="password" type="password" class="form-control" name="password"  maxlength="16">
            </div>   
          <div class="d-flex justify-content-center">
            <input id="showPass" type="checkbox" style = "margin: 10px 5px 0 0" onclick="myFunction()">
            <label for="showPass">Mostrar contrase&ntilde;a</label>
            <!-- <button type="button" class="btn btn-outline-dark" onclick="mostrarPass()" style="margin-left: 10px;">Mostrar contraseña</button> -->
          </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="alertDevolucion()" data-bs-dismiss="modal">Hacer devolución</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Detalle Venta -->
    <?php
      if (isset($_POST['eligeFecha']) && $_POST['eligeFecha'] != "") {
        $data = [
          'idUsuario' => $id_usuario,
          'fecha' => $_POST['eligeFecha']
        ];
      
        $input_from_db = json_decode(POST("Vendedor/services/getSalesPerDate.php",$data), true);
      } else {
          $data = [
            'idUsuario' => $id_usuario
          ];
          $input_from_db = json_decode(POST("Vendedor/services/getSales.php",$data), true);
        }
        foreach($input_from_db as $value){
          $data = [
            'idVenta' => $value[0]
          ];
          $infoSale = json_decode(POST("Vendedor/services/getInfoSale.php",$data), true);
          echo('
          <div class="modal fade bd-example-modal-xl" id="mostrarDetalle'.$value[0].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detalle de Venta</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="mb-3">
                      <label for="vendedor" class="col-form-label">Vendedor</label>
                      <input type="text" class="form-control" id="vendedor" value="'.$infoSale[0][0].'" disabled>
                    </div>
                    <div class="mb-3">
                      <label for="hora" class="col-form-label">Hora</label>
                      <input type="text" class="form-control" id="hora" value="'.hora($infoSale[0][1]).'" disabled>
                    </div>
                    <div class="mb-3">
                      <label for="productos" class="col-form-label">Productos</label>
                      ');
                      
                      foreach($infoSale as $sale){
                        echo ('
                        <ul>
                          <li style="list-style:none;">'
                            .$sale[3] . " " . $sale[2] . '
                          </li>
                        </ul>');
                      }
                      
                      echo('
                    </div>
                    <div class="mb-3">
                      <label for="total" class="col-form-label">Total</label>
                      <input type="text" class="form-control" id="total" value="'. $infoSale[0][5] .'" disabled>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>');
          } 
        }
          
          
          ?>

  </div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
