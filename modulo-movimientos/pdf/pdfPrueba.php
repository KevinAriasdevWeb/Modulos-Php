<?php
#$connect = new mysqli('localhost','developer','elc2022prtc','desarollo');
include "conexion.php";
#var_dump($_POST);

#ini_set("display_errors",1);
#error_reporting(E_ALL);

#$ingreso = $_POST["ingreso"];
#$egreso = $_POST["egreso"];

//$id_movmiento = $_GET['id_movimiento'];

require "./fpdf.php";


if(isset($_POST['buscar']) && isset($_POST['campo']))
{
	$campo=$_POST['campo'];
	$buscar=$_POST['buscar'];   
	$busqueda=" AND $campo like '%$buscar%' ";
}else{

    $busqueda="";

}



$sql = "SELECT * FROM tbl_movimiento where 1=1 $busqueda";

$result = mysqli_query($connect, $sql);


$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();
$contador = 0;
$totalIngresos = 0;
$totalEgresos = 0;

while ($fila = $result->fetch_assoc()) {

	### CONTADOR DE CELDAS
	$contador++;

	$egresoActual = 0;
	$ingresoActual = 0;

	if ($fila['tipo'] == 'ingreso') {
		$totalIngresos += $fila['monto'];
		$ingresoActual = $fila['monto'];
	} else {
		$totalEgresos += $fila['monto'];
		$egresoActual = $fila['monto'];
	}


	$pdf->SetX(50);
	$pdf->SetFont('Arial', '', 6);
	$pdf->Cell(7, 6, $contador, 1);
	$pdf->SetFont('Arial', '', 7);
	$pdf->Cell(20, 6, $fila['fecha_movimiento'], 1);
	$pdf->Cell(32, 6, $fila['categoria'], 1);
	$pdf->Cell(23, 6, $ingresoActual, 1);
	$pdf->Cell(23, 6, $egresoActual, 1);
	$pdf->Cell(20, 6, '', 1);
	$pdf->Ln();
}
#####TOTALES


$pdf->SetFont('Arial', '', 6);
$pdf->Cell(7, 6, '', 0);
$pdf->SetFont('Arial', '', 7);
$pdf->SetX(109);
$pdf->Cell(23, 6,'TOTAL INGRESOS', 1);
$pdf->SetX(132);
$pdf->Cell(23, 6,'TOTAL EGRESOS', 1);
$pdf->SetX(155);
$pdf->Cell(20, 6,'TOTAL', 1);
$pdf->Ln();
$pdf->SetX(109);
$pdf->Cell(23, 6, $totalIngresos, 1);
$pdf->SetX(132);
$pdf->Cell(23, 6, $totalEgresos, 1);
$pdf->SetX(155);
$pdf->Cell(20, 6, $total=($totalIngresos-$totalEgresos), 1);
$pdf->Ln();


//HEADER
$Y_Fields_Name_position = 11;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(50);
$pdf->Cell(7,6,'#',1,0,'L',1);
$pdf->SetX(57);
$pdf->Cell(20,6,'FECHA',1,0,'L',1);
$pdf->SetX(77);
$pdf->Cell(32,6,'DESCRIPCION',1,0,'L',1);
$pdf->SetX(109);
$pdf->Cell(23,6,'INGRESO',1,0,'R',1);
$pdf->SetX(132);
$pdf->Cell(23,6,'EGRESO',1,0,'R',1);
$pdf->SetX(155);
$pdf->Cell(20,6,'TOTAL',1,0,'R',1);

$pdf->Ln();
$fecha = date("Y-m-d");
$pdf->Output("I", "reporte-".$fecha."pdf", true);
