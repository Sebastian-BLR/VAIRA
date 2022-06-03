<?php

$dias_semana = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

// * ========================================================================================================
// *                                            BUSQUEDA                                                   //
// * ========================================================================================================

if(isset($_POST['eligeFechaReporte']) && $_POST['eligeFechaReporte'] != ""){
  $data = [
    'fkUsuario' => $id_usuario,
    'fecha' => $_POST['eligeFechaReporte'],
    'rango' => 1
  ];
  $input_from_db = json_decode(POST('Vendedor/services/filterSalesDate.php', $data), true);
  $total_dia = count($input_from_db);
  $fecha = $_POST['eligeFechaReporte'];
  $_dia = date('w', strtotime($fecha));
  $_mes = date('n', strtotime($fecha)) - 1;
  
  $fecha_parseada = $dias_semana[$_dia] . " " . date('d', strtotime($fecha)) . " " . $meses[$_mes] . " " . date('Y', strtotime($fecha));
}

// * ========================================================================================================
// *                                            SEMANAL                                                    //
// * ========================================================================================================

// ! FOR EXAMPLE
// $data = [
//   'fkUsuario' => $id_usuario,
//   'fecha' => '2022-05-22'
// ];

// ! FOR PRODUCTION
$data = [
  'fkUsuario' => $id_usuario,
  'fecha' => date('Y-m-d'),
  'fkSucursal' => $sucursal
];

$input_week = json_decode(POST('Vendedor/services/getSalesWeek.php', $data), true);
$sales_week = json_decode($input_week[0]);

$total_week = 0;
$semana = [];

foreach($sales_week as $sale){
  $datos = (array)$sale;
  foreach($datos as $data){
    if(gettype($data) == 'object'){
      foreach($data as $dato){
        $ventas = (array)$dato;
        $semana[] = $ventas['Ventas'];
        
      } 
    } else
      $semana[] = 0;
  }
}

// // ! Se obtiene el total de ventas de la semana por dia
// foreach ($sales_week as $sale){
//   foreach ($sale as $sale_detail){
//     if(gettype($sale_detail) == 'array'){
//       $semana[] = count($sale_detail);
//     } else 
//       $semana[] = 0;
//   }
// }

// ! Se obtiene el total de ventas de la semana
foreach ($semana as $dia)
  $total_week += $dia;

$datos_grafica_semana = [];
if ($total_week > 0){
  foreach ($semana as $dia){
    $datos_grafica_semana[] = round( $dia/$total_week, 2);
  }
}else{
  foreach ($semana as $dia){
    $datos_grafica_semana[] = 0;
  }
}

$data_for_w_graph = [];
for($i = 0; $i < count($dias_semana); $i++){
  $data_for_w_graph[] = [
    'dia' => $dias_semana[$i],
    'ventas' => $semana[$i],
    'porcentaje' => $datos_grafica_semana[$i]
  ];
}

// * ========================================================================================================
// *                                           MENSUAL                                                     //
// * ========================================================================================================

$data = [
  'fkUsuario' => $id_usuario,
  'fkSucursal' => $sucursal
];

$input_month = json_decode(POST('Vendedor/services/getSalesMonth.php', $data), true);
// echo('getSalesMonth=> '); var_dump($input_month);
$sales_month = json_decode($input_month[0]);
// echo('getSalesMonth=> '); var_dump($sales_month);

$total_year = 0;
$mes = [];

// ! Se obtiene el total de ventas del año por mes
foreach($sales_month as $sale){
  $datos = (array)$sale;
  foreach($datos as $data){
    if(gettype($data) == 'object'){
      foreach($data as $dato){
        $ventas = (array)$dato;
        $mes[] = $ventas['Ventas'];
        
      } 
    } else
      $mes[] = 0;
  }
}

// // Se obtiene el total de ventas del año por mes
// // foreach ($sales_month as $sale)
// //   foreach ($sale as $sale_detail){
// //     if(gettype($sale_detail) == 'array')
// //       $mes[] = count($sale_detail);
// //     else 
// //       $mes[] = 0;
// //   }

// ! Se obtiene el total de ventas del año
foreach ($mes as $m)
  $total_year += $m;

$datos_grafica_mes = [];
if ($total_year > 0)
  foreach ($mes as $m)
    $datos_grafica_mes[] = round( $m/$total_year, 2);
else
  foreach ($mes as $m)
    $datos_grafica_mes[] = 0;

$data_for_m_graph = [];
for($i = 0; $i < count($meses); $i++){
  $data_for_m_graph[] = [
    'mes' => $meses[$i],
    'ventas' => $mes[$i],
    'porcentaje' => $datos_grafica_mes[$i]
  ];
}
// var_dump($sales_month);
?>
<div class="row" style="margin-top: 5px;font-size: 18px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?nueva_venta=true">Nueva venta</a></li>
      <li class="breadcrumb-item active" aria-current="page">Reportes</li>
    </ol>
    </nav>
</div>
<div class="row" >
  <div class="col" style="font-size: 20px;  margin-top: 5px;">
  <?php if (isset($_POST['eligeFechaReporte']) && $_POST['eligeFechaReporte'] != ''):  ?>
    <p>
      Resumen del <?php echo ($fecha_parseada) ?>
      <div class="row" style="margin-top: 5px;">
        <div class="col-4" style="border-style: none; text-align: left;">
          <a href="?reportes=true" class="btn btn-primary ms-3">
            <i class="fa fa-arrow-left"></i>
          </a>
        </div>
      </div>
    </p>
  <?php else:  ?>
    <p>
      Resumen
    </p>    
    <div class="row" style="margin-top: 5px;">
      <div class="col-4" style="border-style: none; text-align: left;">
        <label class="toggle ms-3" id="status">
          <input type="checkbox" name="modo" id="modo">
          <span class="slider"></span>
        
          <!-- label element 👇 -->
          <span class="labels" data-on="Día" data-off="Mes"></span>
        </label>
      </div>
      <div class="col-5">
        <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;">Ventas por producto</button>
        <button type="button" class="btn btn-outline-dark" style="float: right;">Ventas por categoría</button>
      </div>
      <div class="col-3">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']).'?reportes=true'?>" method="POST" style="display: inline;" style="margin-top:5">
          <input type="date" id="eligeFechaReporte" name="eligeFechaReporte" style="margin-right: 10px;float:left">
          <button type="submit" class="btn btn-primary fa fa-search" style="padding: 5px 12px; margin-top:-.8%;"></button>
        </form>
      </div>
    </div>
  <?php endif;  ?>

  </div>
</div>
<div class="row" style="margin-top:9px" id="graph">
<?php
  if(isset($_POST['eligeFechaReporte']) && $_POST['eligeFechaReporte'] != ''){
    echo ('
      <script>
      const divGrafica = document.getElementById("graph");      
      divGrafica.innerHTML = 
          `
          <table id="animations-example-3" class="charts-css column show-labels data-spacing-5 show-primary-axis" style="max-width: 300px">
            <caption> Ventas por dia </caption>
            <thead>
              <tr>
                <th scope="col"> Dia </th> 
                <th scope="col"> Ventas </th>
                </tr>
            </thead> 
            <tbody class="bodyGrafica">
              <tr>
                <th scope="row">'. $fecha_parseada .'</th>');
                if($total_dia == 0)
                  echo('<td style="--size: 0;">');
                else
                  echo('<td style="--size: 1.0;">');
                echo('<span class="data" style="padding-top: 200px; font-size:35px">'.$total_dia.'</span>
                </td>
              </tr>
            </tbody>
          </table>
          `
      </script>
    ');
  } else {
    echo('
      <script>
        var modo = document.getElementById("modo");
        console.log(modo.checked);
        const divGrafica = document.getElementById("graph");
        if(!modo.checked){            
          divGrafica.innerHTML = 
            `
            <table id="animations-example-3" class="charts-css column show-labels data-spacing-5 show-primary-axis">
              <caption> Animation Example #3 </caption>
              <thead>
                <tr>
                  <th scope="col"> Year </th> 
                  <th scope="col"> Sales </th>
                  </tr>
              </thead> 
              <tbody class="bodyGrafica">');
              foreach($data_for_m_graph as $data){
                echo('
                  <tr>
                    <th scope="row">'. $data['mes'] .'</th>
                    <td style="--size: '. $data['porcentaje'] .';">
                    <span class="data">'.$data['ventas'].'</span>
                    </td>
                  </tr>');
              }
              echo('
              </tbody>
            </table>
            `
        }
        modo.addEventListener("change", function() {
          if(modo.checked){
            divGrafica.innerHTML = 
            `  
            <table id="animations-example-3" class="charts-css column show-labels data-spacing-5 show-primary-axis">
            <caption> Animation Example #3 </caption>
            <thead>
              <tr>
                <th scope="col"> Week </th> 
                <th scope="col"> Sales </th>
                </tr>
              </thead> 
              <tbody class="bodyGrafica"> ');
              foreach($data_for_w_graph as $data){
                echo('
                  <tr>
                    <th scope="row">'. $data['dia'] .'</th>
                    <td style="--size: '. $data['porcentaje'] .';">
                    <span class="data">'.$data['ventas'].'</span>
                    </td>
                  </tr>');
              }
              echo ('
              </tbody>
            </table> `
          } else{
            divGrafica.innerHTML = 
            `
            <table id="animations-example-3" class="charts-css column show-labels data-spacing-5 show-primary-axis">
              <caption> Animation Example #3 </caption>
              <thead>
                <tr>
                  <th scope="col"> Year </th> 
                  <th scope="col"> Sales </th>
                  </tr>
              </thead> 
              <tbody class="bodyGrafica">');
              foreach($data_for_m_graph as $data){
                echo('
                  <tr>
                    <th scope="row">'. $data['mes'] .'</th>
                    <td style="--size: '. $data['porcentaje'] .';">
                    <span class="data">'.$data['ventas'].'</span>
                    </td>
                  </tr>');
              }
              echo('</tbody>
            </table>
            `
          }
        });
      </script>
    ');
  }
?>

</div>
