<?php
    //Incluimos el fichero de conexion
    // include_once("dbconect.php");
    //Incluimos la libreria PDF
    include_once('./fpdf.php');

    class PDF extends FPDF
    {
    // Funcion encargado de realizar el encabezado
    function Header()
    {
        // Logo
        $this->Image('../../src/image/vaira.png',10,-1,50);
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(95,10,'Ticket de compra',1,0,'C');
        // Line break
        $this->Ln(50);
        }
        // Funcion pie de pagina
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    // $db = new dbConexion();
    // $connString = $db->getConexion();
    // $display_heading = array('idp'=>'ID', 'personal_nombre'=> 'Nombre', 'personal_edad'=> 'Edad','personal_salario'=> 'Salario','fecha'=> 'Fecha',);

    // $result = mysqli_query($connString, "SELECT idp, personal_nombre, personal_edad, personal_salario, fecha FROM personal") or die("database error:". mysqli_error($connString));
    // $header = mysqli_query($connString, "SHOW columns FROM personal");
    $result = Array(
    "object"=> Array(   "attr1" => "dato 1", 
                        "attr2" => "dato 2", 
                        "attr3" => "dato 3", 
                        "attr4" => 1200, 
                        "attr5" => "dato 5")
            );
    $pdf = new PDF();
    //header
    $pdf->AddPage();
    //foter page
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',12);
    // Declaramos el ancho de las columnas
    $w = array(80, 25, 20, 30,30);
    //Declaramos el encabezado de la tabla
    $pdf->Cell(80,12,'PRODUCTO',1);
    $pdf->Cell(25,12,'CANTIDAD',1);
    // $pdf->Cell(20,12,'',0);
    $pdf->Cell(30,12,'TOTAL',1);
    // $pdf->Cell(30,12,'',0);
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    //Mostramos el contenido de la tabla
    foreach($result as $row){
        $pdf->Cell($w[0],6,$row['attr1'],1);
        $pdf->Cell($w[1],6,$row['attr2'],1);
        // $pdf->Cell($w[2],6,$row['attr3'],1);
        $pdf->Cell($w[3],6,number_format($row['attr4']),1);
        // $pdf->Cell($w[4],6,$row['attr5'],1);
        $pdf->Ln();
    }
    $pdf->Output();
?>