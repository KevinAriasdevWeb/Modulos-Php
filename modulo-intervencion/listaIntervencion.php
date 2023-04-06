<?php
include("conexion.php");
ini_set('default_charset', 'utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);
##CONSULTA LISTA DE ALUMNOS CON MANITO ARRIBA

$sql = "SELECT * , count(id_intervencion) as contador FROM tbl_intervencion_alumnos group by codigo_matricula";
$listaIntervencion = mysqli_query($connect, $sql);

$sql2 = "SELECT * FROM tbl_matriculas ";
$matriculas = mysqli_query($connect, $sql2);





?>



<style>
    #titulo_h1 {
        color: white;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Kjhk2TvY8MtWg/9F0T/ud0fvNdO8pRH+kbI3N0GJ7YdD8ZWV9K9zOgD7jrk8G8W2Q1m+IuO7LdG8Zn1LZ9FJg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Intervencion Lista Alumno</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 id="titulo_h1"> Intervencion Lista Alumno</h1> .
        </div>

    </nav>
    <div class="container p-4">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>ALUMNO</th>
                    <th>CURSO</th>
                    <th>ESPECIALIDAD</th>
                    <th>MANO ARRIBA</th>
                    <th>ESTADO</th>
                </thead>
                <?php
                   
                   while ($LI = $listaIntervencion->fetch_assoc()) {
                    ?>
                <tbody>
                   
                            <td><?php   foreach ($matriculas as $CM) { 
                                if ($LI['codigo_matricula'] == $CM['codigo_matricula']) {
                                    echo $CM['nombre_alumno'];
                                } } ?></td>
                            <td><?php echo $LI['id_curso']; ?></td>
                            <td><?php echo $LI['id_especialidad']; ?></td>
                            <td><?php echo $LI['contador'];?></td>
                            <td><?php echo $LI['estado']; ?></td>
                   
                </tbody>
                <?php
                   
                } ?>
            </table>
        </div>


    </div>


</body>

</html>


<script>

</script>