<?php

// * ========================================================================================================
// *                                            SEMANAL                                                    //
// * ========================================================================================================

// ! FOR EXAMPLE
// $data = [
//   'fkUsuario' => $id_usuario,
//   'fecha' => '2022-05-22'
// ];

$data = [
  'fkUsuario' => $id_usuario,
  'fecha' => date('Y-m-d')
];

$input_week = json_decode(POST('Vendedor/services/getSalesWeek.php', $data), true);
$sales_week = json_decode($input_week[0]);

$total_week = 0;
$semana = [];
$dias_semana = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];

// ! Se obtiene el total de ventas de la semana por dia
foreach ($sales_week as $sale){
  foreach ($sale as $sale_detail){
    if(gettype($sale_detail) == 'array'){
      $semana[] = count($sale_detail);
    } else 
      $semana[] = 0;
  }
}

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
  'fkUsuario' => $id_usuario
];

$input_month = json_decode(POST('Vendedor/services/getSalesMonth.php', $data), true);
$sales_month = json_decode($input_month[0]);

$total_year = 0;
$mes = [];
$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

// ! Se obtiene el total de ventas del año por mes
foreach ($sales_month as $sale)
  foreach ($sale as $sale_detail){
    if(gettype($sale_detail) == 'array')
      $mes[] = count($sale_detail);
    else 
      $mes[] = 0;
  }

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
    <p>
      Resumen
    </p>
    <div class="row" style="margin-top: 5px;">
      <div class="col-6">
        <label class="toggle" id="status">
          <input type="checkbox" name="modo" id="modo">
          <span class="slider"></span>
        
          <!-- label element 👇 -->
          <span class="labels" data-on="Día" data-off="Mes"></span>
        </label>
      </div>
      <div class="col-6">
        <input type="date" id="eligeFechareporte" name="eligeFechareporte" style="margin-left: 20px;float:right">
        <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;">Ventas por producto</button>
        <button type="button" class="btn btn-outline-dark" style="float: right;">Ventas por categoría</button>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-top:9px" id="graph">
<?php
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
      
      ?>

</div>
