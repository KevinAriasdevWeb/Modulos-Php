<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['enviar']) && !empty($_POST['campo'])) {

    $campo = $_POST['campo'];
    $buscar = $_POST['buscar'];
   

    if (!empty($_POST['campo']) && !empty($buscar)) {
        $busqueda = " AND $campo = '$buscar' ";
    }
} else {
    $busqueda = "";
    
}

##BUSCADO POR FECHA
if (isset($_POST['enviar']) && !empty($_POST["buscafechadesde"]) && !empty($_POST["buscafechahasta"])) {
    $fecha_desde = $_POST["buscafechadesde"];
    $fecha_hasta = $_POST["buscafechahasta"];
    if (!empty($_POST["buscafechadesde"])) {
        $busqueda .= " AND fecha BETWEEN '" . $fecha_desde . "' AND '" . $fecha_hasta . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha DESC ";
    }
} elseif (isset($_POST['enviar']) && !empty($_POST["buscafechadesde"])) {
    $fecha_desde = $_POST["buscafechadesde"];
    if (!empty($_POST["buscafechadesde"])) {
        $busqueda .= " AND fecha  = '" . $fecha_desde . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha DESC ";
    }
} elseif (isset($_POST['enviar']) && !empty($_POST["buscafechahasta"])) {

    $fecha_hasta = $_POST["buscafechahasta"];
    if (!empty($_POST["buscafechahasta"])) {
        $busqueda .= " AND fecha  = '" . $fecha_hasta . "' ";
    }
    if ($_POST["orden"] == '1') {
        $busqueda .= " ORDER BY fecha ASC ";
    }

    if ($_POST["orden"] == '2') {
        $busqueda .= " ORDER BY fecha DESC ";
    }
} else {
    $_POST['buscafechadesde'] = '';
    $_POST['buscafechahasta'] = '';
}


### CONSULTA TAREAS PROGRAMADAS
$sql = "SELECT * FROM tbl_tareas_programadas where 1=1 $busqueda ";
$tareasProgramadas = mysqli_query($connect, $sql);





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
       margin-top: 32px;
    }

    #boton_ver_todo {}

    #th_margin{
margin-left: 15px;
    }

    #btn-ver-todo{
        margin-left: 70px;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Tareas Programadas</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a id="search" href="http://elc.cl/test/tareasProgramadas/tareaProgramadaForm.php" class="btn btn-success mr-sm-3">Crear Tarea</a>
        <ul class="navbar-nav ml-auto">
            <form method="POST" class="form-inline my-2 my-lg-0">
                <table>

                    <body>
                        <tr>
                            <th>
                            <input name="buscar" id="search" class="form-control mr-sm-3" type="search" placeholder="Buscar" aria-label="Search">
                            </th>
                            <th>
                                <p id="texto"> Seleccione campo </p>
                                <select name="campo" class="form-control mr-sm-3 ">
                                    <option value="">Seleccione Campo</option>
                                    <option value="fecha">Fecha</option>
                                    <option value="datos">Causa</option>
                                    <option value="tipo">tipo</option>
                                </select>
                            </th>

                            <th>
                                <p id="texto">Desde </p>
                                <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mr-sm-3 " value="<?php echo $_POST["buscafechadesde"]; ?>">
                            </th>
                            <th>
                                <p id="texto">Hasta </p>
                                <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mr-sm-3 " value="<?php echo $_POST["buscafechahasta"]; ?>">
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
                        </tr>


                        </tbody>
                </table>
            </form>
        </ul>
    </nav>




    <div class="container p-4 ">
    <CENTER>
        <div class="card">
            <div class="card-body">
              

                    <?php
                    echo "
                
                <table class='table table-bordered table-striped p-2'>
                <thead class='table-dark'>
                    <tr>
                        <th class='text-center' scope='col'>CURSO</th>
                        <th class='text-center' scope='col'>TIPO</th>
                        <th class='text-center' scope='col'>CAUSA</th>
                        <th class='text-center' scope='col'>FECHA</th>	
                        <th colspan='2'>
                        <form><button id='btn-ver-todo' name='mostrar' type='submit' class='btn btn-success mr-sm-0 ' style=''>ver todo</button></form>
                    </th>	
                    ";
                    echo "
                </tr>
                </thead>";

                    foreach ($tareasProgramadas as $tp) {
                        echo "<tr>";
                        echo "<td>";
                        echo $tp['id_curso'];
                        echo "</td>";
                        echo "<td>";
                        echo $tp['tipo'];
                        echo "</td>";
                        echo "<td>";
                        echo $tp['datos'];
                        echo "</td>";
                        echo "<td>";
                        echo $tp['fecha'];
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='POST' action='tareaProgramadaEditar.php'>
                     <button value=" . $tp['id_tarea'] . " name='id_tarea' class='btn btn-warning' type='submit'> EDITAR </button>  
                     </form>
                     <td>
                     <form method='POST' action='tareaProgramadaEliminar.php'>
                     <button value=" . $tp['id_tarea'] . " name='eliminar' class='btn btn-warning' type='submit'> ELIMINAR </button>  
                     </form>";
                        echo "</td>";

                        echo "</td>";

                        echo "</tr>";
                    }

                    echo "</table>
                ";

                    ?>




             
            </div>
        </div>
        </CENTER>
    </div>

    <?php

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Tarea Actualizada correctamente!',
                    icon: 'success',
                    timer: 3000,



                });
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }

    ?>

    <?php

    if (isset($_GET['eliminar'])) {
        $eliminar = $_GET['eliminar'];
        if ($eliminar == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Tarea eliminado correctamente!',
                    icon: 'success',
                    timer: 2000,



                });
                setTimeout(function() {
                    window.location.href = "tareaProgramadaTabla.php";
                }, 2000);
            </script>

    <?php
        }
    } else {
        $eliminar = 'null';
    }

    ?>
</body>


</html>