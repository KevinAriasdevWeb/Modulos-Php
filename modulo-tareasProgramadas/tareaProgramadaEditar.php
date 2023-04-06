<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

include('conexion.php');





if (isset($_POST['editar_tarea'])) {
    $id_tarea = $_POST["id_tarea"];
    $id_curso = $_POST["id_curso"];
    $datos = $_POST["causa"];
    $fecha = $_POST["fecha"];
    $tipo = $_POST["tipo"];

  
    $sql1 = ("UPDATE tbl_tareas_programadas SET  id_curso='$id_curso',datos='$datos',
    fecha='$fecha', tipo='$tipo' WHERE id_tarea = '$id_tarea' ");
    $result1 = mysqli_query($connect, $sql1);
    if (!$result1) {
        die('Query Failed');
    } else {

        header("Location: tareaProgramadaEditar.php?estado=ok");
    }
}












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
    <title>Editar Tarea</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Editar Tarea</a>
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>

    <div class="container p-4 ">
        <div class="row m-0 justify-content-center text-center">

            <div class="card">
                <div class="card-body">
                    <?php //inicio de 
                    //Consulta SQL para buscador por id y encontrar datos de contacto a editar
                    //inicio de get recibiendo ID
                    if (isset($_POST['id_tarea'])) {
                        $id = $_POST['id_tarea'];
                        if ($id == $id) {
                            $search_id = $id;

                            $sql2 = "SELECT * FROM tbl_tareas_programadas  WHERE id_tarea  ='" . $search_id . "' ";
                            $tareasProgramadas = mysqli_query($connect, $sql2);
                            if ($tareasProgramadas) {

                                while ($tp = $tareasProgramadas->fetch_assoc()) {
                    ?>
                                    <form method="POST" action="tareaProgramadaEditar.php">

                                        <div class="form">
                                            <div class="form-group ">
                                                <label for="id_curso">Curso</label>
                                                <input type="text" name="id_curso" value="<?php echo $tp['id_curso'] ?>" class="form-control">
                                            <input type="hidden" name="id_tarea" value="<?php echo $tp['id_tarea'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group ">
                                                <label for="causa">Causa</label>
                                                <select class="custom-select mr-sm-2" name="causa" class="form-control">
                                                    <option value="">Seleccione causa</option>


                                                    <?php
                                                    foreach ($causasSuspension as $row) {
                                                    ?>
                                                        <?php
                                                        echo '<option value="' . $row['causa'] . '" ';
                                                        if ($row['causa'] == $tp['datos']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $row['causa'] . ' </option>';
                                                        ?>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" name="fecha" value="<?php echo $tp['fecha'] ?>" class="form-control">
                                            </div>
                                            <label>Tipo</label><br>
                                            <div class="form-group custom-control custom-radio custom-control-inline ">

                                                <input class="form-check-input" type="radio" name="tipo" id="tipo" <?= $tp['tipo'] == "feriado" ? "checked" : "" ?> value="feriado">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Feriado
                                                </label>
                                            </div>
                                            <div class="form-group custom-control custom-radio custom-control-inline">

                                                <input class="form-check-input" type="radio" name="tipo" id="tipo" <?= $tp['tipo'] == "suspension" ? "checked" : "" ?> value="suspension">
                                                <label class="form-check-label" for="exampleRadios1">
                                                Suspension
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button name="editar_tarea" type="submit" class="btn btn-warning btn-block text-center">
                                                    Editar
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                    <?php
                                }
                            }
                        }
                    }
                    ?>

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
                    title: 'Tarea re-programada correctamente!',
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