<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

include('conexion.php');




##SE EJECUTA LA CONSULTA EDITAR
if (isset($_POST['editar-diploma'])) {
    $id_diploma = $_POST["id_diploma"];
    $codigo_matricula = $_POST["codigo_matricula"];
    $id_curso = $_POST["id_curso"];
    $fecha = $_POST["fecha"];
    $fecha2 = $_POST["fecha2"];
    $estado = $_POST["estado"];


    $sql1 = ("UPDATE tbl_diplomas SET  codigo_matricula='$codigo_matricula',id_curso='$id_curso',
    fecha='$fecha', estado='$estado', fecha2='$fecha2' WHERE id_diploma = '$id_diploma' ");
    $diplomasUpdate = mysqli_query($connect, $sql1);
    if (!$diplomasUpdate) {
        die('Query Failed');
    } else {

        header("Location: diplomasEditar.php?estado=ok");
    }
}


##CONSULTA MATRICULAS
$sql = "SELECT * FROM tbl_matriculas";
$ConsultaMatriculas = mysqli_query($connect, $sql);

##CONSULTA TBL_CENTRODEINGRESO (CURSO)
$sql2 = "SELECT * FROM tbl_centrosdeingreso";
$ConsultaCurso = mysqli_query($connect, $sql2);

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
                    if (isset($_POST['editar'])) {
                        $id = $_POST['editar'];
                        if ($id == $id) {
                            $search_id = $id;

                            $sql2 = "SELECT * FROM tbl_diplomas  WHERE id_diploma  ='" . $search_id . "' ";
                            $editarDiploma = mysqli_query($connect, $sql2);
                            if ($editarDiploma) {

                                while ($ED = $editarDiploma->fetch_assoc()) {
                    ?>
                                    <form method="POST" action="diplomasEditar.php">

                                        <div class="form">
                                            <div class="form-group col-md-auto">
                                                <label for="negocios">Codigo Matricula</label>
                                                <input type="hidden" name="id_diploma" value="<?php echo $ED['id_diploma'];?>">
                                                <select name="codigo_matricula" class="form-control" required>
                                                    <option value="" selected>Seleccione Matricula</option>
                                                    <?php
                                                    foreach ($ConsultaMatriculas as $CodigoMatriculas) {

                                                        echo '<option value="' . $CodigoMatriculas['codigo_matricula'] . '" ';
                                                        if ($ED['codigo_matricula'] == $CodigoMatriculas['codigo_matricula']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $CodigoMatriculas['nombre_alumno'] . "  RUT: " . $CodigoMatriculas['rut_alumno'] . '</option>';
                                                    }


                                                    ?>

                                                </select>

                                            </div>
                                            <div class="form-group col-md-auto">
                                                <label for="negocios">ID Curso</label>
                                                <select name="id_curso" class="form-control" required>
                                                    <option value="" selected>Seleccione Curso</option>
                                                    <?php
                                                    foreach ($ConsultaCurso as $curso) {
                                                        echo '<option value="' . $curso['id_centroingreso'] . '" ';
                                                        if ($ED['id_curso'] == $curso['id_centroingreso']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >"' . $curso['nombre'] . '"</option>';
                                                    }


                                                    ?>

                                                </select>

                                            </div>

                                            <div class="form-group col-md-auto">
                                                <label for="inputCodigo">Fecha Inicio</label>
                                                <input type="date" name="fecha" value="<?php echo $ED['fecha']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-auto">
                                                <label for="inputCodigo">Fecha Modificacion o termino</label>
                                                <input type="date" name="fecha2" value="<?php echo $ED['fecha2']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group col-md-auto">
                                                <label for="estado">Estado</label>
                                                <select name="estado" class="form-control" required>
                                                    <option value="">Seleccione Estado</option>
                                                    <?php

                                                    echo '<option value="1" ';


                                                    if ($ED['estado'] == 1) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >Solicitud creada </option>';
                                                    echo '<option value="2" ';
                                                    if ($ED['estado'] == 2) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >Impreso </option>';
                                                    echo '<option value="3" ';
                                                    if ($ED['estado'] == 3) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >Enviado a notaria </option>';
                                                    echo '<option value="4" ';
                                                    if ($ED['estado'] == 4) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >Disponible para retiro </option>';
                                                    echo '<option value="5" ';
                                                    if ($ED['estado'] == 5) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >Entregado </option>';
                                                    ?>
                                                </select>

                                            </div>


                                            <button name="editar-diploma" type="submit" class="btn btn-warning btn-block text-center">
                                                Editar Diploma
                                            </button>
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
                    title: 'Diploma Editado correctamente!',
                    icon: 'success',
                    timer: 3000,



                });
                setTimeout(function() {
                    window.location.href = "diplomasTabla.php";
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