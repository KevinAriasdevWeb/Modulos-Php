<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');
include('conexion.php');

$sql1 = ("SELECT * FROM tbl_centrosdeingreso");
$resultado = mysqli_query($connect, $sql1);
if (!$resultado) {
    die('Falla al ingreso de datos');
} else {
}

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $tiempo = $_POST['tiempo'];
    $especialidad = $_POST['especialidad'];
} else {
    $nombre = '';
    $descripcion = '';
    $tiempo = '';
    $especialidad = '';
}





?>

<style>
    .box {

        width: 33% !important;
        max-width: 33%;
        display: inline;
        padding: 20px;
        text-align: left;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Formulario Preguntas Test</title>
</head>

<body>
    <div class="container p-4 ">
        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="preguntasTestForm.php">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" value="<?php echo $nombre ?>" placeholder="Ingrese nombre del test" class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="textarea">Descripcion</label>
                                    <textarea name="descripcion" class="form-control rounded-0" maxlength:="1024" oninput="this.value = this.value.replace(/[^a-zA-Z0-9º!#$%&/()=ñÑ¡!¿?;,.°áíóúé ]/,'')" id="exampleFormControlTextarea2" rows="5" required><?php echo $descripcion;  ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="tiempo">Tiempo</label>
                                    <input type="text" name="tiempo" value="<?php echo $tiempo ?>" placeholder="Ingrese tiempo del test" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputRegion">Especialidad</label>
                                    <select name="especialidad" class="form-control" onchange="this.form.submit()">
                                        <option value="">Seleccione especialidad</option>
                                        <?php
                                        foreach ($resultado as $row) {
                                        ?>
                                        <?php

                                            if (empty($_POST['especialidad'])) {
                                                echo '<option value="' . $row['id_centroingreso'] . '">' . $row['nombre'] . ' </option>';
                                            } elseif (!empty($_POST['especialidad'])) {

                                                echo '<option value="' . $row['id_centroingreso'] . '" ';


                                                if ($_POST['especialidad'] == $row['id_centroingreso']) {
                                                    echo ' selected ';
                                                }
                                                echo ' >' . $row['nombre'] . ' </option>';
                                            }
                                        }




                                        ?>
                                    </select>
                                </div>

                                <?php

                                if (isset($_POST['especialidad'])) {
                                    $especialidad = $_POST['especialidad'];
                                    $sql2 = ("SELECT * FROM tbl_preguntas_tests WHERE id_especialidad ='$especialidad'");


                                    $resultado2 = mysqli_query($connect, $sql2);

                                    $cont = 0;
                                    while ($mostrar = $resultado2->fetch_assoc()) {
                                        $cont++;
                                ?>


                                        <div class=" box">
                                            <input class="form-check-input" type="checkbox" id="preguntas[]" name="preguntas[]" value='<?php echo $mostrar['id_pregunta_test']; ?>'>
                                            <label class="form-check-label" for="defaultCheck1"><?= $cont ?>.<?php echo $mostrar['pregunta']; ?></label>

                                        </div>

                                <?php
                                    }
                                }
                                ?>
                                <button formaction="preguntasTestAdd.php" name="ingresar_test" type="submit" class="btn btn-success btn-block text-center">
                                    Ingresar Pregunta test
                                </button>
                        </form>
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
                            title: 'Test Ingresado correctamente!',
                            icon: 'success',
                            timer: 5000,



                        });
                        setTimeout(function() {
                            window.location.href = "tablatest.php";
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