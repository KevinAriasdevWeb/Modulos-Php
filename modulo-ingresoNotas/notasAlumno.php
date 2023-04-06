<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

##Ingresamos la id_evaluacion y id_curso por url para obtener datos
if (isset($_POST['id_evaluacion'])) {
    $id_evaluacion = $_POST['id_evaluacion'];
} elseif (isset($_GET['id_evaluacion'])) {
    $id_evaluacion = $_GET['id_evaluacion'];
}

if (isset($_POST['id_curso'])) {
    $id_curso = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
}

if (isset($id_evaluacion) && isset($id_curso)) {
    ##Se tiene que rescatar el dato de id_evaluacion
    $sql = "SELECT * FROM tbl_educacion_evaluacion where id_evaluacion='$id_evaluacion' ";
    $result = mysqli_query($connect, $sql);

    ##Consulta para traer nombres de tipo de ponderaciones. Teorico,Pruebas,Examen etc...
    $sql2 = "SELECT * FROM tbl_ponderaciones ";
    $result2 = mysqli_query($connect, $sql2);
} else {

    if (!isset($id_evaluacion)) {
        echo "<p>NINGUN TEST HA SIDO SELECCIONADO</p>";
    } else {
        if (!isset($id_curso)) {
            echo "<p>NO HA SIDO ENCONTRADO UN CURSO DE ALUMNO PARA LA CONSULTA</p>";
        }
    }
}

##Consulta para traer nombres de alumnos de tbl_matriculas
$sql3 = "SELECT * FROM tbl_matriculas where id_curso='$id_curso'";
$result3 = mysqli_query($connect, $sql3);




?>
<style>
    #tabla_largo {
        width: 433px;
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
    <title>Notas Alumno</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Notas Alumno</a>
        <ul class="navbar-nav ml-auto">
            <form method="POST" class="form-inline my-2 my-lg-0">
            </form>
        </ul>
    </nav>

    <div class="container p-4 ">

        <div class="col p-5 text-center">
            <?php
            ##Incio while con datos tbl_educacion_evaluacion 
            while ($fila = $result->fetch_assoc()) {
            ?>
                <div class="card">
                    <div class="card-body">

                        <div id='card_completa' class='card '>
                            <div class='card-body  '>
                                <?php ##Aqui va el titulo 
                                ?>
                                <div id='header_card' class='row align-items-center card-header bg-dark text-white '>
                                    <div class='col'>
                                        <h5 class='card-title'>Curso: <?php echo $fila['nombre'] ?></h5>
                                    </div>
                                </div>
                                <?php ##Aqui va el contenido en el centro 
                                ?>
                                <div id='body_card' class='row align-items-start card-body text-black'>
                                    <div class='col'>
                                        <p class='text-end text-justify '>Tipo Evaluacion: <?php foreach ($result2 as $fila2) {
                                                                                                if ($fila['tipo'] == $fila2['id_ponderaciones']) {
                                                                                                    echo $fila2['nombre'];
                                                                                                }
                                                                                            };  ?><br><br>
                                            Ponderacion: <?php echo $fila['ponderacion'] ?> <br><br>

                                            Fecha evaluacion: <?php echo $fila['fecha_evaluacion'] ?>
                                        </p>

                                    </div>
                                </div>
                                <div id='footer_card' class='row align-items-end card-footer  '>
                                    <?php ##Aqui va el footer 
                                    ?>
                                    <div class='col'> </div>
                                    <div class='col'> </div>
                                </div>
                            </div>

                        </div>


                        <br>
                        <br>
                        <br>


                        <?php ##Incio Form 
                        ?>

                        <div class="form-row">
                          
                                <div class="form-check">


                                    <table table class="table table-hover table-bordered">
                                        <thead class="thead-dark">

                                            <tr>
                                                <th id="tabla_largo" scope="col">#</th>
                                                <th id="tabla_largo" scope="col">Alumno</th>
                                                <th id="tabla_largo" scope="col">Nota</th>
                                                <th id="tabla_largo" scope="col">Accion</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <div class="form-group row">
                                                <?php
                                                $contador = 1;
                                                foreach ($result3 as $fila3) { ?>
                                                    <tr>
                                                        <td id="tabla_largo">
                                                            <div class="form-group col-md-4">

                                                                <?php echo $contador; ?>

                                                            </div>
                                                        </td>

                                                        <td id="tabla_largo">

                                                            <?php echo $fila3['nombre_alumno']; ?>

                                                        </td>

                                                        <form method="POST">
                                                            <td>

                                                                <?php $fechaActual = date('Y-m-d'); ?>


                                                                <input type="text" name="notas_alumno[][<?php echo $fila['id_evaluacion'] ?>][<?php echo $fila3['codigo_matricula'] ?>][<?php echo $fechaActual ?>]" placeholder="Nota Alumno" class="form-control">


                                                                <?php
                                                                ##echo $fila3['codigo_matricula'];
                                                                ##echo $fila['id_evaluacion'];
                                                                ?>


                                                            </td>
                                                            <td>

                                                                <button formaction="notasAlumnoAdd.php" name="enviar_nota" type="submit" class="btn btn-success btn-block text-center"> Ingresar Nota </button>


                                                            </td>
                                                        </form>

                                            </div>
                                            </tr>
                                        <?php $contador++;
                                                } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <button name="enviar_notas" type="submit" class="btn btn-success btn-block text-center"> Ingresar Notas </button>
                         


                        </div>

                    </div>
                </div>

        </div>

    <?php
                ##Final while
            } ?>



    <?php

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Encuesta enviada con exito!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "mostrarEncuesta.php";
                }, 5000);
            </script>

        <?php
        }
    } else {
        $estado = 'null';
    }



    //Mensaje por si existe matricula registrada y encuesta respondida
    if (isset($_GET['respondido'])) {
        $estado = $_GET['respondido'];
        if ($estado == "ok") {
        ?>
            <script type="text/javascript">
                swal({
                    title: 'Encuesta ya fue respondida!!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "mostrarEncuesta.php";
                }, 5000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }
    ?>















</body>

</html>