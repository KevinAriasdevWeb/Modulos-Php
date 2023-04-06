<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['id_curso'])) {
    $id_curso = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
}




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
}



?>

<style>
    .table {}

    #tabla_largo {}

    #tabla {}
</style>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Notas Curso</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Notas Curso</a>
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>



    <div class="row m-0 justify-content-center">


        <div class="container p-4 ">


            <div class="col p-5 text-center">


                <?php

                echo "<table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>COD MATRICULA</th>
                        <th scope='col'>ALUMNO</th>		
                    ";

                foreach ($evaluacionesConsulta as $ev) {
                    echo "<th scope='col'>" . strtoupper($ev['nombre']) . "</th>";
                }
                echo "</tr>
                </thead>";

                foreach ($matriculasConsulta as $mc) {
                    echo "<tr>";
                    echo "<td>";
                    echo $mc['codigo_matricula'];
                    echo "</td>";
                    echo "<td>";
                    echo $mc['nombre_alumno'];
                    echo "</td>";

                    foreach ($evaluacionesConsulta as $ev) {
                        echo "<td>";
                        $nota = 0;
                        foreach ($notasConsulta as $nc) {
                            if ($nc['codigo_matricula'] == $mc['codigo_matricula'] && $nc['id_evaluacion'] == $ev['id_evaluacion']) {
                                $nota = $nc['nota'];
                            }
                        }
                        echo $nota;
                        echo "</td>";
                    }


                    echo "</tr>";
                }

                echo "</table>";

                ?>



            </div>
        </div>

    </div>

</body>

</html>