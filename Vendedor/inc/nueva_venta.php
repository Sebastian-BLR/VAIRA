
  <div class="row" style="margin-top: 5px;font-size: 19px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Nueva venta</li>
    </ol>
    </nav>
</div>
  <button style="margin-left: 1.4%" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <input id="buscar_producto_entrada" style="float: left; width: 50%; margin-top: 1.35%" class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search">
  <button type="button" class="btn btn-secondary"  style="margin-left: 29%"><i class="fa fa-filter"></i>Filtrar</button>
  <div class="wrapper"  style="height:70vh;">
    <?php 
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
                    <h6 class="card-title">precio: $'.round($value[5],2).'</h6>
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


<div class="col-4" style="height:80vh; overflow-y: scroll;" >
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
          function removeProducto(id_producto){
            let parameters = new FormData()
            parameters.append("id_producto", id_producto)
            var object = {};
            parameters.forEach((value, key) => {object[key] = value});
            var json_send = JSON.stringify(object);

            fetch("./services/removeFromCart.php/", {
                method: "POST",
                body: json_send
            }).then(
                response => response.json()
            ).then(
                response => {
                  console.log(response)
                }
            ).catch(
                error => console.log(error)
            )
          
          }
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
              <div  class="col-sm-1">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeProducto('.$value[0].')" ><i class="fa fa-trash"></i></button>
                <input hidden id="ticket_product_'.$index.'_price" value="'.$value[1].'">
              </div>

            </div>
          <script>
            
            
            let ticket_product_'.$index.'_cant = document.getElementById("ticket_product_'.$index.'_cant")
            var product_cost_'.$index.'  = 0
            ticket_product_'.$index.'_cant.addEventListener("change", function() {
              product_cost_'.$index.' = ticket_product_'.$index.'_cant.value * document.getElementById("ticket_product_'.$index.'_price").value
              document.getElementById("ticket_product_'.$index.'_cost").innerHTML = "$ "+ (product_cost_'.$index.').toFixed(2)
              updateTicket()
            })
            product_cost_'.$index.' = ticket_product_'.$index.'_cant.value * document.getElementById("ticket_product_'.$index.'_price").value
            document.getElementById("ticket_product_'.$index.'_cost").innerHTML = "$ "+ (product_cost_'.$index.').toFixed(2)
          </script>
          ');
          $index++;
        }
        if(count($input_from_db ) > 0){
          echo('
            <br>
            <div class="row justify-content-md-center">
              <div class="col-sm-6" >
                <h4 id="ticket_IVA">$ 00</h4>
                <h4 id="ticket_total">$ 00</h4>
              </div>
            </div>
           

            <br><br>
            <div class="row justify-content-md-center">
              <div class="col-sm-6" >
              <button style="margin-bottom: 25px;" id="generate_ticket_button" type="button" class="btn btn-primary">Generar venta</button>
              </div>
            </div>
            

            <script>
          

            let ticket_subtotal = document.getElementById("ticket_subtotal")
            let ticket_IVA = document.getElementById("ticket_IVA")
            let ticket_total = document.getElementById("ticket_total")

         
            let updateTicket= () =>{
              var subtotal = 0

              for(var i = 0; i < '.$index.'; i++){
                subtotal += eval("product_cost_" + i)
              }
              ticket_IVA.innerHTML = "IVA $" + (subtotal*.16).toFixed(2)
              ticket_total.innerHTML = "Total $" + (subtotal).toFixed(2)
            }
            updateTicket()

            let generate_ticket_button = document.getElementById("generate_ticket_button")
            generate_ticket_button.addEventListener("click",() => {
              let parameters = new FormData()
              parameters.append("id_usuario", 1)          //hace falta agregar las variables que se necesiten
              var object = {};
              parameters.forEach((value, key) => {object[key] = value});
              var json_send = JSON.stringify(object);
              fetch("./services/generateSale.php/", {
                method: "POST",
                body: json_send
              }).then(
                  response => response.json()
              ).then(
                  response => console.log(response)
              ).catch(
                  error => console.log(error)
              )
              Swal.fire({
                title: "¿Deseas imprimir el ticket?",
                showDenyButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Imprimir",
                denyButtonText: "Cancelar",
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.assign("./services/downloadTicket.php")
                
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