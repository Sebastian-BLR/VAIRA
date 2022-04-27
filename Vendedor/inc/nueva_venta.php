  <button type="button" class="btn btn-secondary"><i class="fa fa-filter"></i>Filtrar</button>
  <div class="wrapper">
    <?php 
    // the variable $input_from_db stores all data from database as list (if not make adjustments in foreach)

    include '../services/helper.php';
    $data = [
      "sucursal" => "1"
    ];
    $input_from_db = json_decode(Post("services/getAllProducts.php",$data), true);
    $index = 0;
      foreach($input_from_db as $value){
        if($index % 4 == 0){
          echo('
            <div class="row">
          ');
        }
        echo('
            <div class="card" style="width: 12rem;">
              <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?nueva_venta=true" method="POST">
                  <input hidden name="id_producto" value='.$value[0].'> </input>
                  <input hidden name="cantidad" value=1> </input>
                  <img src="'.'./src/image/papas.png'.'" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">'.$value[1].'</h5>
                    <h7 class="card-title">cantidad: '.$value[2].'</h7> <br>
                    <h7 class="card-title">sku:'.$value[3].'</h7> <br>
                    <h6 class="card-title">precio: $'.$value[5].'</h6>
                    <button type="submit" name="add_to_cart" value="true" class="btn btn-primary">Agregar a carrito</button>
                  </div>
              </form>

            </div>
        ');
        $index++;
        if($index != 0 && $index % 4 == 0){
          echo('
            </div>
          ');
        }
      }
      if($index % 4 != 0){
        echo('
          </div>
        ');
      }
    ?>
    
  </div>

</div> <!-- This div closes 'col' for 'indexvendedor.php' to start a new one below -->


<div class="col-4">
  <h1>Carrito de compra</h1>
      <h4>Sucursal</h4>
      <?php>
        include '../services/helper.php';
        $data = [
          "usuario" => $id_usuario,
          "punto" => $id_punto_de_venta
        ];
        $input_from_db = json_decode(Post("services/getShoppingCart.php",$data), true);
        $index = 0;
        echo("<br><br><br>");
        foreach($input_from_db as $value){
          echo('
          <div>
            <input hidden type="text" name="" value="Submit">
            <h4 style="display:inline-block;">'.$value[0].'</h4>
            <p style="display:inline-block;">x'.$value[2].'</p>
            <h5 style="display:inline-block;">$'.$value[1].'</h5>
          </div>
          ');

          $index++;

        }
      ?>
  <!-- <div class="btn-group">
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Punto de venta </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">1</a></li>
        <li><a class="dropdown-item" href="#">2</a></li>
        <li><a class="dropdown-item" href="#">3</a></li>
      </ul>
    </div> 
  </div>-->
<!-- The first div closes in the next php file   -->