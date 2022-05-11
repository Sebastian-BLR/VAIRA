
  <button style="margin-left: 1.4%" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <input style="float: left; width: 50%; margin-top: 1.35%" class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search">
  <button type="button" class="btn btn-secondary"  style="margin-left: 29%"><i class="fa fa-filter"></i>Filtrar</button>
  <div class="wrapper"  style="height:82vh;">
    <?php 
    // the variable $input_from_db stores all data from database as list (if not make adjustments in foreach)
    

    $data = [
      "sucursal" => "1"
    ];
    $input_from_db = json_decode(Post("Vendedor/services/getAllProducts.php",$data), true);
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


<div class="col-4" style="height:90vh; overflow-y: scroll;" >
  <h1>Carrito de compra</h1>

      

      <?php
        $data = [
          "usuario" => $id_usuario,
          "punto" => $id_punto_de_venta
        ];
        $input_from_db = json_decode(Post("Vendedor/services/getShoppingCart.php",$data), true);
        $index = 0;
        echo('
          <div class="btn-group">
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Punto de venta </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">1</a></li>
                <li><a class="dropdown-item" href="#">2</a></li>
                <li><a class="dropdown-item" href="#">3</a></li>
              </ul>
            </div> 
          </div>
        ');
        echo('<br><br><br>
        <script>
        var subtotal_acumulado = 0
        </script>
        ');

        foreach($input_from_db as $value){
          echo('
          <div class="row justify-content-md-center">
            <div class="col-sm-2" >
              <input id="ticket_product_'.$index.'_cant" type="number" min="1" value="'.$value[2].'" style="width:100%;">
            </div>
            <div class="col-sm-5">
              <h4>'.$value[0].'</h4>
            </div>
            <div  class="col-sm-4">
              <h4 id="ticket_product_'.$index.'_cost">$</h4>
            </div>
            <input hidden id="ticket_product_'.$index.'_price" value="'.$value[1].'">
          </div>
          <script>
            
            let ticket_product_'.$index.'_cant = document.getElementById("ticket_product_'.$index.'_cant")
            var product_cost_'.$index.'  = 0
            ticket_product_'.$index.'_cant.addEventListener("change", function() {
              product_cost_'.$index.' = ticket_product_'.$index.'_cant.value * document.getElementById("ticket_product_'.$index.'_price").value
              product_cost_'.$index.' = Math.round(product_cost_'.$index.' * 100) / 100
              document.getElementById("ticket_product_'.$index.'_cost").innerHTML = "$ "+ product_cost_'.$index.'
              updateTicket()
            })
            product_cost_'.$index.' = ticket_product_'.$index.'_cant.value * document.getElementById("ticket_product_'.$index.'_price").value
            document.getElementById("ticket_product_'.$index.'_cost").innerHTML = "$ "+ product_cost_'.$index.'
          </script>
          ');
          $index++;
        }
        if(count($input_from_db ) > 0){
          echo('
            <br>
            <div class="row justify-content-md-center">
              <div class="col-sm-6" >
                <h4 id="ticket_subtotal">$ 60</h4>
                <h4 id="ticket_IVA">$ 60</h4>
                <h4 id="ticket_total">$ 60</h4>
              </div>
            </div>
           

            <br><br>
            <div class="row justify-content-md-center">
              <div class="col-sm-6" >
              <button id="generate_ticket_button" type="button" class="btn btn-primary">Generar ticket</button>
              </div>
            </div>
            

            <script>
            let ticket_subtotal = document.getElementById("ticket_subtotal")
            let ticket_IVA = document.getElementById("ticket_IVA")
            let ticket_total = document.getElementById("ticket_total")

         
            let updateTicket= () =>{
              var subtotal = 0
              var IVA = 0

              for(var i = 0; i < '.$index.'; i++){
                subtotal += eval("product_cost_" + i)
              }
              subtotal = Math.round(subtotal * 100) / 100
              ticket_subtotal.innerHTML = "Subtotal $" + subtotal
              ticket_IVA.innerHTML = "IVA $" + 0
              ticket_total.innerHTML = "Total $" + (subtotal + IVA)
            }
            updateTicket()

            let generate_ticket_button = document.getElementById("generate_ticket_button")
            generate_ticket_button.addEventListener("click",()=>{
              Swal.fire({
                title: "¿Deseas imprimir el ticket?",
                showDenyButton: true,
                confirmButtonText: "Imprimir",
                denyButtonText: "Cancelar",
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire("Compra registrada, imprimiendo ticket...", "", "success")
                } else if (result.isDenied) {
                  Swal.fire("Cancelando compra...", "", "info")
                }
              })
            })
           
            
          </script>
          ');
        }
      ?>
     
      
<!-- The first div closes in the next php file   -->