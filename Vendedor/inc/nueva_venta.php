
  <div class="row" style="margin-top: 5px;font-size: 19px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Nueva venta</li>
      </ol>
    </nav>
</div>
  <div class="row">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']).'?nueva_venta=true'?>" class="col-9 buscar" method="POST">
      <!-- <input id="buscar_producto_entrada" style="float: left; width: 50%; margin-top: 1.35%" class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search">
      <button style="margin: 1.4% 0 0 1.4%;" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
       -->
      <input id="buscar_producto_entrada" name="busqueda" type="text" placeholder="Buscar producto">
      <button type="submit" class="btn btn-primary fa fa-search" style="padding: 5px 12px; margin-top:-.8%;"></button>
    </form>
    <form action="<?php echo( htmlspecialchars($_SERVER["PHP_SELF"]) ).'?nueva_venta=true' ?>" method="POST" class="col-3">
    <button type="button" class="btn btn-secondary"  data-bs-toggle="dropdown" style="margin-left: 29%; margin-top:-.8%;"><i class="fa fa-filter"></i>Filtrar</button>
      <ul class="dropdown-menu">
        <?php
        // var_dump($categorias);
        foreach ($categorias as $categoria) {
          echo '<li><button type="submit" class="dropdown-item" name="categoria" value="'.$categoria[0].'">'.$categoria[1].'</button></li>';
        }
        ?>
      </ul>
    </form>
  </div>
  <div class="wrapper"  style="height:65vh;">
    <?php 
    $data = [
      "sucursal" => $sucursal[0][0]
    ];
    if(isset($_POST['busqueda'])){
      $data = [
        "sucursal" => $sucursal[0][0],
        "busqueda" => trim($_POST['busqueda'])
      ];
      $input_from_db = json_decode(Post("Vendedor/services/getSearch.php",$data),true);
    } else if (isset($_POST['categoria'])) {
      $data = [
        "sucursal" => $sucursal[0][0],
        "categoria" => $_POST['categoria']
      ];
      $input_from_db = json_decode(Post("Vendedor/services/getFilters.php",$data),true);
    } else {
      $input_from_db = json_decode(Post("Vendedor/services/getAllProducts.php",$data),true);
    }
    $index = 0;
      foreach($input_from_db as $value){
        if($index % 4 == 0){
          echo('
            <div class="row">
          ');
        }
        if($value[4]==null)
          $value[4] = "default.jpg";
        echo('
            <div class="card" style="width: 12rem;">
              <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?nueva_venta=true" method="POST">

                  <input hidden name="id_producto" value='.$value[0].'> </input>
                  <input hidden name="cantidad" value=1> </input>
                  <input hidden name="nombre_producto" value="'.$value[1].'"> </input>
                  <input hidden name="precio_unitario" value="'.$value[5].'"> </input>
                  <input hidden name="sku_producto" value="'.$value[3].'"> </input>
                  
                  <img src="'.'../src/image/productos/'.$value[4].'" class="card-img-top" alt="...">
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

      if ($input_from_db == null)
        echo('<p>No se encontraron productos</p>');
    ?>
    
  </div>

</div> <!-- This div closes 'col' for 'indexvendedor.php' to start a new one below -->


<div class="col-4" style="height:80vh; overflow-y: scroll;" >
  <h1>Carrito de compra <?php echo(trim($_SESSION['id_punto_de_venta']))  ?></h1>

      

      <?php
        $data = [
          "usuario" => $id_usuario,
          "punto" => trim($_SESSION['id_punto_de_venta'])
        ];  

        // $data = [
        //   "usuario" => $id_usuario,
        //   "punto" => $id_punto_de_venta[1][0]
        // ];

        // $input_from_db = json_decode(Post("Vendedor/services/getShoppingCart.php",$data), true);
        $index = 0;
        // echo ('
        //   <div class="row">
        //     <div class="col-12">
        //       <p>'. $_SESSION['id_punto_de_venta'] .'</p>
        //     </div>
        //   </div>
        
        // ');
        echo('
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?nueva_venta=true" method="POST" style="min-height: 0px; max-height:0px;">
          <div class="btn-group">
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Punto de venta </button>
              <ul class="dropdown-menu">');
              foreach($id_punto_de_venta as $punto){
                echo(
                  "<li><button type='submit' class='dropdown-item' name='punto_de_venta' value='$punto[0]'>$punto[1]</button></li>"
                );
              }
              echo('</ul>
              </div> 
            </div>
          </form>
        ');
        echo('<br><br><br>
        <script>
          var subtotal_acumulado = 0
         
        </script>
        ');
        if(isset($_POST["remove_product_from_id"])){
          foreach ($_SESSION["cart"] as $clave => $valor){
            if($valor["id_producto"] == $_POST["remove_product_from_id"]){
              unset($_SESSION["cart"][$clave]);
              unset($_POST["remove_product_from_id"]);
            }
          }
        
        }
            if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $value){
              echo('
                <div class="row justify-content-md-center">
                  <div class="col-sm-2" >
                    <input id="ticket_product_'.$index.'_cant" type="number" min="1" name="cantidad_actual_producto" value="'.$value["cantidad"].'" style="width:100%;">
                  </div>
                  <div class="col-sm-5">
                    <h5>'.$value["nombre_producto"].'</h5>
                  </div>
                  <div  class="col-sm-4">
                    <h4 id="ticket_product_'.$index.'_cost">$</h4>
                  </div>
                  <div  class="col-sm-1">
                  <form method="POST">
                    <button type="submit" class="btn btn-danger btn-sm" name=remove_product_from_id value='.$value["id_producto"].' ><i class="fa fa-trash"></i></button>
                  </form >
                    <input hidden id="ticket_product_'.$index.'_price" value="'.$value["precio_unitario"].'">
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
            if(count($_SESSION["cart"] ) > 0){
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

            var global_total = global_iva = 0
            let updateTicket= () =>{
              var subtotal = 0

              for(var i = 0; i < '.$index.'; i++){
                subtotal += eval("product_cost_" + i)
              }
              global_total = (subtotal).toFixed(2)
              global_iva = (subtotal*.16).toFixed(2)
              ticket_IVA.innerHTML = "IVA $" + global_iva
              ticket_total.innerHTML = "Total $" + global_total
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
                  
                  window.location.assign(`./services/downloadTicket.php?productos=`+
                  `'.urlencode( json_encode($_SESSION["cart"]) ).'`+
                  `&nombre_tienda=`+`Tienda de Aaron`+
                  `&direccion=`+`Calle villa de aaron xD`+
                  `&total=`+String(global_total)+
                  `&iva=`+String(global_iva)
                  )


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