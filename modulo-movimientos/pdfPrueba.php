<?php
#$connect = new mysqli('localhost','developer','elc2022prtc','desarollo');
include "conexion.php";
//var_dump($connect);
 
#ini_set("display_errors",1);
#error_reporting(E_ALL);

#$ingreso = $_POST["ingreso"];
#$egreso = $_POST["egreso"];

//$id_movmiento = $_GET['id_movimiento'];

	require "./fpdf.php";

$sql = ("SELECT * FROM tbl_movimiento ");
$result = mysqli_query($connect, $sql);


	$pdf = new FPDF('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();
$contador=0;
$totalIngresos=0;
$totalEgresos=0;

while ($fila = $result->fetch_assoc()) {

	### CONTADOR DE CELDAS
	$contador++;

$egresoActual=0;
$ingresoActual=0;

	if($fila['tipo']=='ingreso')
	{
		$totalIngresos+=$fila['monto'];
		$ingresoActual=$fila['monto'];
	}else{
		$totalEgresos+=$fila['monto'];
		$egresoActual=$fila['monto'];		
	}



	$pdf->SetFont('Arial','',6);
	$pdf->Cell(7,6,$contador,1);	
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(15,6,$fila['fecha_movimiento'],1);
	$pdf->Cell(15,6,$fila['categoria'],1);
	$pdf->Cell(15,6,$ingresoActual,1);	
	$pdf->Cell(15,6,$egresoActual,1);	
    $pdf->Ln();
}
#####TOTALES


	$pdf->SetFont('Arial','',6);
	$pdf->Cell(7,6,'',0);	
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(15,6,'',0);
	$pdf->Cell(15,6,'',0);
	$pdf->Cell(15,6,$totalIngresos,1);	
	$pdf->Cell(15,6,$totalEgresos,1);	
    $pdf->Ln();


	$pdf->Output("I","reporte1.pdf",true);


?>
