<?php

include "conexion.php";
#var_dump($_POST);

ini_set("display_errors", 1);
error_reporting(E_ALL);

require "./fpdf.php";

if (isset($_POST['id_curso'])) {
    $id_curso = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
}

##INICIO ISSET
if (isset($id_curso)) {

    ### CONSULTA EVALUACIONES, FILTRADO POR CURSO
    $sql = "SELECT * FROM tbl_educacion_evaluacion where id_curso = '$id_curso'";
    $evaluacionesConsulta = mysqli_query($connect, $sql);
    ### CONSULTA NOTAS
    $sql2 = "SELECT * FROM tbl_notas ";
    $notasConsulta = mysqli_query($connect, $sql2);
    ### CONSULTA MATRICULAS
    $sql3 = "SELECT * FROM tbl_matriculas where id_curso = '$id_curso'";
    $matriculasConsulta = mysqli_query($connect, $sql3);
    ### CONSULTA NOMBRE CURSO
    $sql4 = "SELECT * FROM tbl_centrosdeingreso where id_centroingreso = '$id_curso'";
    $nombreCurso = mysqli_query($connect, $sql4);


##PAGINA HORIZONTAL
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();
##POSICION DE NOMBRES EJE Y
$Y_Fields_Name_position = 50;
#POSCICION DE TABLA EJE Y
$Y_Table_Position = 56;

### TITULO Y DESCRIPCION

$pdf->SetFont('Arial', 'B', 13);
$pdf->SetTextColor(33, 33, 33);
foreach ($nombreCurso as $nombreDelCurso){
    $nombre=$nombreDelCurso['nombre'];
}
$pdf->Cell(0, 10, utf8_decode($nombre), 0, 0, 'C');
$pdf->SetTextColor(33, 33, 33);
$pdf->Cell(-190, 35, utf8_decode(strtoupper('')), 0, 0, 'C');
$pdf->SetY($Y_Table_Position);
$contador = 1;
foreach ($matriculasConsulta as $mc) {

    ### CELDAS NOTAS

    $pdf->SetX(60);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(7, 6, $contador++, 1);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(23, 6, $mc['nombre_alumno'], 1);

    foreach ($evaluacionesConsulta as $ev) {
        $nota = 0;
        foreach ($notasConsulta as $nc) {
            if ($nc['codigo_matricula'] == $mc['codigo_matricula'] && $nc['id_evaluacion'] == $ev['id_evaluacion']) {

                $nota = $nc['nota'];
            }
        }
        $pdf->Cell(29, 6, $nota, 1, 0, 'C');
    }

    $pdf->Ln();
}

$pdf->SetFillColor(232, 232, 232);
#Bold Font for Field Name
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(60);
$pdf->Cell(7, 6, '#', 1, 0, 'L', 1);
$pdf->SetX(67);
$pdf->Cell(23, 6, 'Alumnos', 1, 0, 'L', 1);
#####TITULOS DE EVALUACIONES
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(232, 232, 232);
foreach ($evaluacionesConsulta as $ev) {


    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x, $y);
    $pdf->multicell(29, 6, utf8_decode($ev['nombre']), 1, 'L', TRUE);
    $pdf->SetXY($x + 24, $y);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x + 5, $y);
}


##FECHA 
$fecha = date("Y-m-d");
$pdf->SetY(10);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(33, 33, 33);
$pdf->Cell(450, 10, utf8_decode('Fecha: ' . $fecha), '', 0, 'C');



$fecha = date("Y-m-d");
$pdf->Output("I", "reporteNotas-" . $fecha . "pdf", true);

} else {

    ##EN CASO NO EXISTA UN ID CURSO MOSTRARA MENSAJE 
        if (!isset($id_curso)) {
    
    ?>
            <style>
                * {
                    font-family: Google sans, Arial;
                }
    
                html,
                body {
                    margin: 0;
                    padding: 0;
                }
    
                .flex-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    color: black;
                    animation: colorSlide 15s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;
    
                }
    
                h1,
                h3 {
                    text-align: center;
                    margin: 10px;
                    cursor: default;
                    color: black;
    
    
                }
    
                @keyframes colorSlide {
                    0% {
                        background-color: white;
                    }
    
                    25% {
                        background-color: white;
                    }
    
                    50% {
                        background-color: white;
                    }
    
                    75% {
                        background-color: white;
                    }
    
                    100% {
                        background-color: white;
                    }
                }
    
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                    }
    
                    ;
    
                    100% {
                        opacity: 1;
                    }
                }
            </style>
    
    
    <?php
    
    
            echo "  <div class='flex-container'>
                <div class='text-center'>
                    <h1>
                    <span class='fade-in' id='digit1'></span>
                    <span class='fade-in' id='digit2'></span>
                    <span class='fade-in' id='digit3'></span>
                    </h1>
                    <h3 class='fadeIn'>NO HA SIDO ENCONTRADO UN CURSO PARA LA CONSULTA</h3>
                
                </div>
                </div>";
        }
    }
    #FINAL ISSET