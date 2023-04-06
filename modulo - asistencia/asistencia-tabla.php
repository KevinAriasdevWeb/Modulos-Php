<?php
include('conexion.php');
ini_set('default_charset', 'utf-8');

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {

    $campo = $_POST['campo'];
    $buscar = $_POST['buscar'];
    $busqueda = "AND $campo like '%$buscar%' ";
}

$sql2 = "SELECT * FROM tbl_control_asistencia where 1=1 $busqueda";

$sql = ("SELECT * FROM tbl_matriculas");

$sql4 = ("SELECT * FROM tbl_control_asistencia");
//Consulta datos tbl_control_asistencia
$result4 = mysqli_query($connect, $sql4);
$mostrar4 = $result4->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Asistencia</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Alumnos - Asistencia</a>
        <ul class="navbar-nav ml-auto">
            <form method="POST" class="form-inline my-2 my-lg-0">
                <select name="campo" class="form-control mr-sm-3 ">
                    <option value="">Seleccione Campo</option>
                    <option value="fecha">Fecha</option>
                </select>
                <input name="buscar" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button name="enviar" value="1" class="btn btn-success mr-sm-3 " type="submit"> Buscar </button>
                <button name="mostrar" class="btn btn-success my-2 my-sm-0" type="submit"> Mostrar Todo </button>
            </form>
        </ul>
    </nav>

    <div class="row m-0 justify-content-center">

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <form method="POST" action="asistencia-tabla.php">
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CODIGO</th>
                        <th scope="col">ASISTENCIA</th>
                        <th scope="col">Editar</button></th>
                        <th scope="col"><button name="asistencia" type="submit"> Enviar Asistencia </button></th>

                </tr>
            </thead>

            <tbody>
                <?php
                //Consulta datos tbl_matriculas
                $result = mysqli_query($connect, $sql);
                $asistencias = $_POST['asistencias'];

                while ($mostrar = $result->fetch_assoc()) {

                ?>
                    <tr>
               
                        <th><?php echo $mostrar['nombre_alumno']; ?></th>
                        <td><?php echo $mostrar['codigo_matricula']; ?></td>
                        <td><input type="checkbox" id="asistencias[]" name="asistencias[]" value="<?php echo $mostrar['codigo_matricula']; ?>">
                        </td>
                        <?php $fecha =  date("Y-m-d"); ?>
                        <?php
                        foreach ($result4 as $row) {
                        ?>
                        <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
                        <input type="hidden" name="id_matricula" value="<?php echo $mostrar['id_matricula']; ?>">
                        <input type="hidden" name="id_curso" value="<?php echo $mostrar['id_curso']; ?>">
                       
                        </form>
                        

                            <td>
                                <?php



                                if ($row['asiste'] == 1) {
                                ?>
                                    <button name="editar-asistencia" type="submit">Editar Asistencia</button>
                                <?php

                                }
                                ?>
                            </td>
                    </tr>
            <?php
                        }
                    }
            ?>

            </tbody>

        </table>

    </div>



    <?php


    if (isset($_POST['asistencia'])) {

        $fecha = $_POST['fecha'];
        $hora_llegada = 0;
        $hora_salida = 0;
        #$id_matricula = $_POST['id_matricula'];
        $id_curso =  $_POST['id_curso'];
        $asistencias = $_POST['asistencias'];
        $fecha_registro = date_create();
        $fecha_registro = date('Y-m-d H:i:s');
        $id_clase = 1;
        $id_usuario = 1;

        $result = mysqli_query($connect, $sql);

        while ($mostrar = $result->fetch_assoc()) {
            if (in_array($mostrar['codigo_matricula'], $asistencias)) {
                $asiste = 1;
            } else {
                $asiste = 0;
            }
            $id_matricula = $mostrar['id_matricula'];

            $sql3 = ("INSERT INTO tbl_control_asistencia(id_matricula,fecha,hora_llegada,hora_salida,asiste,time_registro,id_clase,id_curso,id_usuario) 
            VALUES ('$id_matricula','$fecha','$hora_llegada','$hora_salida','$asiste','$fecha_registro','$id_clase','$id_curso','$id_usuario')");
            $result3 = mysqli_query($connect, $sql3);
            /**
         if(!$connect->query($sql3)){
         $timestamp = new DateTime();
        $data_err = " {
             \"title\": \" Select statement error \",
             \"date_time\": ".$timestamp->getTimestamp().",
             \"error\":\" ".$connect->error." \"
            } "; // Do more information
         }
            echo "<pre>".$data_err."</pre>"; 
             **/

            if (!$result3) {
                die('Falla al ingreso de datos');
            } else {
                header("Location: asistencia-tabla.php?estado=ok");
            }
        }
    }



    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Asistencia agregada correctamente!',
                    icon: 'success',
                    timer: 5000,
                });
                setTimeout(function() {
                    window.location.href = "asistencia-tabla.php";
                }, 1000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }

    ?>
</body>

</html>