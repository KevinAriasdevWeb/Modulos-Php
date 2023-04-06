<?php
include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Diploma Formulario</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="" class="navbar-brand">Diplomas Formulario</a>
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>
    <div class="container p-4 ">
        <div class="row m-0 justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="diplomasAdd.php">

                        <div class="form">
                            <div class="form-group col-md-auto">
                                <label for="negocios">Codigo Matricula</label>
                                <select name="codigo_matricula" class="form-control" required>
                                    <option value="" selected>Seleccione Matricula</option>
                                    <?php
                                    foreach ($ConsultaMatriculas as $CodigoMatriculas) {
                                    ?>

                                        <option value="<?php echo $CodigoMatriculas['codigo_matricula'] ?>">
                                            <?php echo "" . $CodigoMatriculas['nombre_alumno'] . "  RUT: " . $CodigoMatriculas['rut_alumno']  ?>
                                        </option>

                                    <?php
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
                                    ?>

                                        <option value="<?php echo $curso['id_centroingreso'] ?>">
                                            <?php echo $curso['nombre']  ?>
                                        </option>

                                    <?php
                                    }


                                    ?>

                                </select>

                            </div>

                            <div class="form-group col-md-auto">
                                <label for="inputCodigo">Fecha</label>
                                <input type="date" name="fecha" class="form-control">
                            </div>

                            <div class="form-group col-md-auto">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control" required>
                                    <option value="" selected>Seleccione Estado</option>
                                    <option value="1"> Solicitud creada</option>
                                    <option value="2"> Impreso</option>
                                    <option value="3"> Enviado a notaria</option>
                                    <option value="4"> Disponible para retiro</option>
                                    <option value="5"> Entregado</option>
                                </select>

                            </div>


                            <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                                Ingresar Diploma
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <?php

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Diploma ingresado correctamente!',
                    icon: 'success',
                    timer: 1500,



                });
                setTimeout(function() {
                    window.location.href = "diplomasTabla.php";
                }, 1500);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }

    ?>



</body>

</html>