<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

include('conexion.php');



$sql1 = ("SELECT * FROM tbl_causas_suspension ");
$causasSuspension = mysqli_query($connect, $sql1);
if (!$causasSuspension) {
    die('Falla al ingreso de datos');
} else {
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Tareas Programadas</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Tareas Programadas</a>
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>

    <div class="container p-4 ">
        <div class="row m-0 justify-content-center text-center">

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="tareaProgramadaAdd.php">

                        <div class="form">
                            <div class="form-group ">
                                <label for="id_curso">Curso</label>
                                <input type="text" name="id_curso" placeholder="ID curso" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="causa">Causa</label>
                                <select class="custom-select mr-sm-2" name="causa" class="form-control">
                                    <option value="">Seleccione causa</option>
                                    <?php
                                    foreach ($causasSuspension as $row) {
                                        echo '<option value="' . $row['causa'] . '">' . $row['causa'] . ' </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" class="form-control">
                            </div>
                            <label>Tipo</label><br>
                            <div class="form-group custom-control custom-radio custom-control-inline ">

                                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="feriado">
                                <label class="form-check-label" for="exampleRadios1">
                                    Feriado
                                </label>
                            </div>
                            <div class="form-group custom-control custom-radio custom-control-inline">

                                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="suspencion">
                                <label class="form-check-label" for="exampleRadios1">
                                    Suspension
                                </label>
                            </div>
                            <div class="form-group">
                                <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Tarea programada correctamente!',
                    icon: 'success',
                    timer: 3000,



                });
                setTimeout(function() {
                    window.location.href = "tareaProgramadaTabla.php";
                }, 3000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }

    ?>

</body>

</html>