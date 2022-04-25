  <button type="button" class="btn btn-secondary"><i class="fa fa-filter"></i>Filtrar</button>
  <div class="wrapper">
    <?php 
    // Here starts a request to get data from the data base
    // the variable $input_from_db stores all data from database as list (if not make adjustments in foreach)
    $input_from_db = array(
      "key1"=>"",
      "key2"=>"",
      "key3"=>"",
      "key4"=>"",
      "key5"=>"",
    );
    $index = 0;
      foreach($input_from_db as $value){
        if($index % 4 == 0){
          echo('
            <div class="row">
          ');
        }
        //In between the pair of dots is supposed to be the variable $value andin brackets the specific value retrieved from the db
        // NOTE:  the intire card must be a <form> to make a POST request, do not leave it as GET request
        echo('
          <div class="card" style="width: 12rem;">
            <img src="'.'imagenes/papas.png'.'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.'Nombre de producto'.'</h5>
              <a href="#" class="btn btn-primary">'.'Agregar a carrito'.'</a>
            </div>
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
<!-- The first div closes in the next php file   -->