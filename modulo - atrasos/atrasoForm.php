<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
##BUSCADOR POR CAMPO
if (isset($_POST['enviar']) && !empty($_POST['campo']) ) {

    $campo = $_POST['campo'];
    $buscar = $_POST['buscar'];
    $empleado_buscado = $_POST['empleado_buscado'];

    if (!empty($_POST['campo']) && !empty($buscar)) {
        $busqueda = " AND $campo = '$buscar' ";
    }
    
    if(!empty($_POST['campo']) && !empty($empleado_buscado)){
        $busqueda = " AND $campo = '$empleado_buscado' ";
    }
} else {
    $busqueda = "";
}

##BUSCADO POR FECHA
if (isset($_POST['enviar']) && !empty($_POST["buscafechadesde"]) && !empty($_POST["buscafechahasta"])) {
    $fecha_desde = $_POST["buscafechadesde"];
    $fecha_hasta = $_POST["buscafechahasta"];
    if (!empty($_POST["buscafechadesde"])) {
        $busqueda .= " AND fecha_atraso BETWEEN '" . $fecha_desde . "' AND '" . $fecha_hasta . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha_atraso ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha_atraso DESC ";
    }
} elseif (isset($_POST['enviar']) && !empty($_POST["buscafechadesde"])) {
    $fecha_desde = $_POST["buscafechadesde"];
    if (!empty($_POST["buscafechadesde"])) {
        $busqueda .= " AND fecha_atraso  = '" . $fecha_desde . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha_atraso ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha_atraso DESC ";
    }
} elseif (isset($_POST['enviar']) && !empty($_POST["buscafechahasta"])) {

    $fecha_hasta = $_POST["buscafechahasta"];
    if (!empty($_POST["buscafechahasta"])) {
        $busqueda .= " AND fecha_atraso  = '" . $fecha_hasta . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha_atraso ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha_atraso DESC ";
    }
} else {
    $_POST['buscafechadesde'] = '';
    $_POST['buscafechahasta'] = '';
}

##RECIBE LOS DATOS DEL FORMULARIO EDITAR
if (isset($_POST['editar_atraso'])) {
    $fecha_atraso = $_POST["fecha_atraso"];
    $minutos = $_POST["minutos"];
    $id_empleado = $_POST["id_empleado"];
    $id_atrasos = $_POST["id_atrasos"];

    $sql1 = ("UPDATE tbl_atrasos SET fecha_atraso='$fecha_atraso',
    minutos_atraso='$minutos',id_empleado='$id_empleado' WHERE id_atrasos = '$id_atrasos' ");
    $result1 = mysqli_query($connect, $sql1);

    #echo $sql1;

    /**  if(!$connect->query($sql1)){
        $timestamp = new DateTime();
       $data_err = " {
            \"title\": \" Select statement error \",
            \"date_time\": ".$timestamp->getTimestamp().",
            \"error\":\" ".$connect->error." \"
           } "; // Do more information
        }
           echo "<pre>".$data_err."</pre>";
     */
    if (!$result1) {
        die('Query Failed');
    } else {

        header("Location: atrasoForm.php?editar=ok");
    }
}


##BUSQUEDA POR CAMPO FECHA
$sql1 = "SELECT * FROM tbl_atrasos where 1=1 $busqueda";
$empleadoAtrasado = mysqli_query($connect, $sql1);


##CONSULTA DE EMPLEADOS
$sql2 = "SELECT * FROM tbl_empleados";
$empleados = mysqli_query($connect, $sql2);



?>

<style>
    #tabla_datos {
        width: 765;
        margin-left: 162px;
    }

    #texto {

        color: white;
    }

    #alto_tabla {
        height: 15px;
    }

    #search {
        width: 160px;
    }

    #boton_ver_todo {}

    #th_margin{
margin-left: 15px;
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
    <title>Formulario Atrasos</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand">Formulario Atraso</a>
    <ul class="navbar-nav ml-auto">
        <form method="POST" class="form-inline my-2 my-lg-0">
            <table>
                <body>
                    <tr >
                        <th>
                            
                        </th>
                        <th >
                            <p id="texto"> Seleccione campo a buscar </p>
                            <select name="campo" class="form-control mr-sm-2 ">
                                <option value="">Seleccione Campo</option>
                                <option value="fecha_atraso">Fecha atraso</option>
                                <option value="id_empleado">Empleado</option>
                            </select>
                        </th>
                        <th>
                            <p id="texto"> Seleccione empleado</p>
                            <select name="empleado_buscado" class="form-control mr-sm-2 ">
                                <option value="">Seleccione empleado</option>
                                <?php
                                foreach ($empleados as $row) {
                                    echo '<option value="' . $row['id_empleado'] . '">' . $row['nombres'] . ' </option>';
                                }
                                ?>
                            </select>
                        </th>

                        <th>
                            <p id="texto">Desde </p>
                            <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mr-sm-2 " value="<?php echo $_POST["buscafechadesde"]; ?>">
                        </th>
                        <th>
                            <p id="texto">Hasta </p>
                            <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mr-sm-2 " value="<?php echo $_POST["buscafechahasta"]; ?>">
                        </th>
                        <th>
                            <p id="texto"> Selecciona el orden</p>
                            <select name="orden" class="form-control mr-sm-2 ">
                                <option value="">Seleccione el orden</option>
                                <option value="1">Antiguas</option>
                                <option value="2">Recientes</option>
                            </select>
                        </th>
                        <th>
                            <button name="enviar" type="submit" class="btn btn-success mr-sm-1" style="margin-top: 29px;">buscar</button>
                        </th>
                        <th>

                        </th>
                    </tr>


                    </tbody>
            </table>
        </form>
    </ul>
    </nav>




    <div class="container p-4 ">

        <div class="card">
            <div class="card-body">
                <?php
                ##SI ES EDITAR TRAE LOS DATOS DEL ID PARA EDITAR
                if (isset($_POST['editar'])) {

                    $id = $_POST['id_atraso_editar'];
                    if ($id == $id) {
                        $search_id = $id;

                        $sql3 = "SELECT * FROM tbl_atrasos  WHERE id_atrasos  ='" . $search_id . "' ";
                        $result3 = mysqli_query($connect, $sql3);
                        if ($result3) {

                            while ($editarEmpleadoAtrasado = $result3->fetch_assoc()) {

                ?>

                                <form method="POST" action="atrasoForm.php">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="fecha_atraso">Fecha Atraso</label>
                                            <input type="date" name="fecha_atraso" value="<?php echo $editarEmpleadoAtrasado['fecha_atraso'] ?>" placeholder="Fecha Movimiento" class="form-control">
                                        </div>
                                        <input type="hidden" name="id_atrasos" value="<?php echo $editarEmpleadoAtrasado['id_atrasos'] ?>">
                                        <div class="form-group col-md-4">
                                            <label for="minutos">Minutos</label>
                                            <input type="text" value="<?php echo $editarEmpleadoAtrasado['minutos_atraso'] ?>" name="minutos" placeholder="Minutos (Numeros)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_empleado">Empleado</label>
                                            <select name="id_empleado" class="form-control">
                                                <option value="">Seleccione empleado</option>
                                                <?php

                                                foreach ($empleados as $empleadosNombres) {
                                                ?>
                                                <?php

                                                    echo '<option value="' . $editarEmpleadoAtrasado['id_empleado'] . '" ';


                                                    if ($empleadosNombres['id_empleado'] == $editarEmpleadoAtrasado['id_empleado']) {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >' . $empleadosNombres['nombres'] . ' </option>';
                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <button name="editar_atraso" type="submit" class="btn btn-warning btn-block text-center">
                                            editar
                                        </button>
                                    </div>
                                </form>
                    <?php
                            }
                        }
                    }
                } else {
                    ##SINO TRAE EL FORMULARIO PARA INGRESAR EMPLEADOS ATRASADOS
                    ?>

                    <form method="POST" action="atrasoAdd.php">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="fecha_atraso">Fecha Atraso</label>
                                <input type="date" name="fecha_atraso" placeholder="Fecha Movimiento" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="minutos">Minutos</label>
                                <input type="text" name="minutos" placeholder="Minutos (Numeros)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_empleado">Empleado</label>
                                <select name="id_empleado" class="form-control">
                                    <option value="">Seleccione empleado</option>
                                    <?php
                                    foreach ($empleados as $row) {
                                        echo '<option value="' . $row['id_empleado'] . '">' . $row['nombres'] . ' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                                Ingresar
                            </button>
                        </div>
                    </form>



                <?php
                }
                ?>

            </div>
        </div>


        <br>
        <br>
        <?php #tabla con datos de atraso
        ?>

        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th>FECHA ATRASO</th>
                    <th>MINUTOS ATRASO</th>
                    <th>EMPLEADO</th>
                    <th colspan="2">
                        <form><button id="boton_ver_todo" name="mostrar" type="submit" class="btn btn-success mr-sm-1 " style="">ver todo</button></form>
                    </th>

                </tr>
            </thead>
            <tbody>

                <?php

                while ($empleadoAtrasado1 = $empleadoAtrasado->fetch_assoc()) {
                ?>


                    <tr>
                        <th><?php echo $empleadoAtrasado1['fecha_atraso']; ?></th>
                        <td><?php echo $empleadoAtrasado1['minutos_atraso']; ?></td>
                        <td>
                            <?php

                            foreach ($empleados as $empleados2) {

                                if ($empleados2['id_empleado'] == $empleadoAtrasado1['id_empleado']) {
                                    echo   $empleados2['nombres'];
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <form method="POST" action="atrasoForm.php">
                                <input type="hidden" name="id_atraso_editar" value="<?php echo $empleadoAtrasado1['id_atrasos']; ?>">
                                <button name="editar" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="atrasoEliminar.php">
                                <button value="<?php echo $empleadoAtrasado1['id_atrasos']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button>
                            </form>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>


    <?php


    if (isset($_GET['eliminar'])) {
        $eliminar = $_GET['eliminar'];
        if ($eliminar == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Empleado eliminado correctamente!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "atrasoForm.php";
                }, 2000);
            </script>

        <?php
        }
    } else {
        $eliminar = 'null';
    }



    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
        ?>
            <script type="text/javascript">
                swal({
                    title: 'Datos ingresados correctamente!',
                    icon: 'success',
                    timer: 2000,



                });
                setTimeout(function() {
                    window.location.href = "atrasoForm.php";
                }, 2000);
            </script>

        <?php
        }
    } else {
        $estado = 'null';
    }

    if (isset($_GET['editar'])) {
        $editar = $_GET['editar'];
        if ($editar == "ok") {
        ?>
            <script type="text/javascript">
                swal({
                    title: 'Empleado Editado con exito!',
                    icon: 'success',
                    timer: 2000,



                });
                setTimeout(function() {
                    window.location.href = "atrasoForm.php";
                }, 2000);
            </script>

    <?php
        }
    } else {
        $movimiento = 'null';
    }

    ?>

</body>

</html>