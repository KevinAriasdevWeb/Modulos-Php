<?php
include('conexion.php');
ini_set('default_charset', 'utf-8');
ini_set("display_errors",1);
error_reporting(E_ALL);

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {

    $campo = $_POST['campo'];
    $buscar = $_POST['buscar'];
    $busqueda = " AND $campo like '%$buscar%'";
}
$sql2 = ("SELECT * FROM tbl_empleados");
$result2 = mysqli_query($connect, $sql2);
if (!$result2) {
    die('Query Failed1');
}

$sql = "SELECT * FROM tbl_empleados where 1=1 $busqueda";

//Tabla Ciudades
$sql3 = ("SELECT * FROM tbl_ciudades ");
$resultado3 = mysqli_query($connect, $sql3);
if (!$resultado3) {
    die('Falla al ingreso de datos');
} else {
}
//Tabla Comunas
$sql4 = ("SELECT * FROM tbl_comunas ");
$resultado4 = mysqli_query($connect, $sql4);
if (!$resultado4) {
    die('Falla al ingreso de datos');
} else {
}
//tabla regiones
$sql5 = ("SELECT * FROM tbl_regiones ");
$resultado5 = mysqli_query($connect, $sql5);
if (!$resultado5) {
    die('Falla al ingreso de datos');
} else {
}
?>

<style>
    .table {
        margin-left: 0px;
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
    <title>Empleados</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Lista Empleados</a>
        <ul class="navbar-nav ml-auto">
        <a href="http://elc.cl/test2/usuarios/formusuarios.php"  target="_blank" class="btn btn-success mr-sm-3">Crear usuario</a>
            <a href="http://elc.cl/test/empleados/empleadosForm.php"  target="_blank" class="btn btn-success mr-sm-3">Crear empleado</a>
            <form method="POST" class="form-inline my-2 my-lg-0">
                <select name="campo" class="form-control mr-sm-3 ">
                    <option value="">Seleccione Campo</option>
                    <option value="rut">rut</option>
                    <option value="nombres">nombres</option>
                </select>
                <input name="buscar" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button name="enviar" value="1" class="btn btn-success mr-sm-3 " type="submit"> Buscar </button>
                <button name="mostrar" class="btn btn-success my-2 my-sm-0" type="submit"> Mostrar Todo </button>
            </form>
        </ul>
    </nav>
    <?php
    #	$sql = "SELECT * FROM tbl_matriculas";
    $result = mysqli_query($connect, $sql);
    while ($mostrar = $result->fetch_assoc()) {
    ?>
        <div class="row m-0 justify-content-center">
            <table class="table table-striped table-responsive">
                <tr>

                    <!--columna 1-->
                    <td>
                        <table class="table-striped table-bordered table-hover">
                            <tr>
                                <td>ID</td>
                                <td><?php echo $mostrar['id_empleado']; ?></td>
                            </tr>
                            <tr>
                                <td>RUT</td>
                                <td><?php echo $mostrar['rut']; ?></td>
                            </tr>
                            <tr>
                                <td>ESTADO</td>
                                <td><?php echo $mostrar['estado']; ?></td>
                            </tr>
                            <tr>
                                <td>NOMBRES</td>
                                <td><?php echo $mostrar['nombres']; ?></td>
                            </tr>
                            <tr>
                                <td>PATERNO</td>
                                <td><?php echo $mostrar['paterno']; ?></td>
                            </tr>
                            <tr>
                                <td>MATERNO</td>
                                <td><?php echo $mostrar['materno']; ?></td>
                            </tr>
                            <tr>
                                <td>FECHA NACIMIENTO</td>
                                <td><?php echo $mostrar['fecha_nacimiento']; ?></td>
                            </tr>
                            <tr>
                                <td>TELEFONO</td>
                                <td><?php echo $mostrar['telefono']; ?></td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td><?php echo $mostrar['email']; ?></td>
                            </tr>
                            <tr>
                                <td>DIRECCION</td>
                                <td><?php echo $mostrar['direccion']; ?></td>
                            </tr>
                            <tr>
                                <td>REGION</td>
                                <td><?php  //Muestra el nombre de la region por id_region
                                    foreach ($resultado5 as $row5) {
                                        if ($mostrar['id_region'] == $row5['id_region']) {
                                            echo $row5['nombre_region'];
                                        }
                                    } ?></td>
                            </tr>
                            <tr>
                                <td>CIUDAD</td>
                                <td><?php  //Muestra el nombre de la ciudad por id_ciudad
                                    foreach ($resultado3 as $row3) {
                                        if ($mostrar['id_ciudad'] == $row3['id_ciudades']) {
                                            echo $row3['nombre_ciudad'];
                                        }
                                    } ?></td>
                            </tr>
                            <tr>
                                <td>COMUNA</td>
                                <td><?php
                                    //Muestra el nombre de la comuna por id_comuna
                                    foreach ($resultado4 as $row4) {
                                        if ($mostrar['id_comuna'] == $row4['id_comuna']) {
                                            echo $row4['nombre'];
                                        }
                                    } ?></td>
                            </tr>
                            <tr>
                                <td>CARGO</td>
                                <td><?php echo $mostrar['id_cargo']; ?></td>
                            </tr>

                        </table>

                    </td>

                    <!--columna 2-->

                    <td>

                        <table class="table-striped table-bordered table-hover">


                            <tr>
                                <td>SEXO</td>
                                <td><?php echo $mostrar['sexo']; ?></td>
                            </tr>
                            <tr>
                                <td>ESTADO CIVIL</td>
                                <td><?php echo $mostrar['estado_civil']; ?></td>
                            </tr>
                            <tr>
                                <td>NACIONALIDAD</td>
                                <td>
                                    <?php echo $mostrar['nacionalidad']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>SUELDO BASE</td>
                                <td><?php echo $mostrar['sueldo_base']; ?></td>
                            </tr>
                            <tr>
                                <td>VALOR HORA</td>
                                <td><?php echo $mostrar['valor_hora']; ?></td>
                            </tr>
                            <tr>
                                <td>MONTO</td>
                                <td><?php echo $mostrar['monto']; ?></td>
                            </tr>
                            <tr>
                                <td>COMISION</td>
                                <td><?php echo $mostrar['comision']; ?></td>
                            </tr>
                            <tr>
                                <td>BONO COLACION</td>
                                <td><?php echo $mostrar['bono_colacion']; ?></td>
                            </tr>
                            <tr>
                                <td>BONO MOVILIZACION</td>
                                <td><?php echo $mostrar['bono_movilizacion']; ?></td>
                            </tr>
                            <tr>
                                <td>FECHA INGRESO</td>
                                <td><?php echo $mostrar['fecha_ingreso']; ?></td>
                            </tr>
                            <tr>
                                <td>HORA ENTRADA</td>
                                <td><?php echo $mostrar['hora_entrada']; ?></td>
                            </tr>
                            <tr>
                                <td>HORA SALIDA</td>
                                <td><?php echo $mostrar['hora_salida']; ?></td>
                            </tr>
                            <tr>
                                <td>COLACION</td>
                                <td><?php echo $mostrar['tiempo_colacion']; ?></td>
                            </tr>
                            <tr>
                                <td>AFP</td>
                                <td><?php echo $mostrar['id_afp']; ?></td>
                            </tr>
                        </table>

                    </td>
                    <!--columna 3-->
                    <td>
                        <table class="table-striped table-bordered table-hover">


                            <tr>
                                <td>SALUD</td>
                                <td><?php echo $mostrar['id_salud']; ?></td>
                            </tr>
                            <tr>
                                <td>PLAN SALUD</td>
                                <td><?php echo $mostrar['plan_salud']; ?></td>
                            </tr>
                            <tr>
                                <td>PLAN SALUD2</td>
                                <td><?php echo $mostrar['plan_salud2']; ?></td>
                            </tr>
                            <tr>
                                <td>APV</td>
                                <td><?php echo $mostrar['apv']; ?></td>
                            </tr>
                            <tr>
                                <td>CARGAS FAMILIARES</td>
                                <td><?php echo $mostrar['cargas_familiares']; ?></td>
                            </tr>
                            <tr>
                                <td>ANT MEDICOS</td>
                                <td><?php echo $mostrar['ant_medicos']; ?></td>
                            </tr>
                            <tr>
                                <td>CONTACTO URGENCIA</td>
                                <td><?php echo $mostrar['contacto_urgencia']; ?></td>
                            </tr>
                            <tr>
                                <td>GRUPO SANGUINEO</td>
                                <td><?php echo $mostrar['grupo_sanguineo']; ?></td>
                            </tr>
                            <tr>
                                <td>CONTRATO</td>
                                <td><?php echo $mostrar['link_contrato']; ?></td>
                            </tr>
                            <tr>
                                <td>CV</td>
                                <td><?php echo $mostrar['link_cv']; ?></td>
                            </tr>
                            <tr>
                                <td>CERTIFICADOS</td>
                                <td><?php echo $mostrar['link_certificados']; ?></td>
                            </tr>
                            <tr>
                                <td>NUMERO CUENTA</td>
                                <td><?php echo $mostrar['nro_cuenta']; ?></td>
                            </tr>
                            <tr>
                                <td>BANCO</td>
                                <td><?php echo $mostrar['banco']; ?></td>
                            </tr>


                            <form method="POST" action="empleadosEditar.php?id=<?php echo $mostrar['id_empleado']; ?>">
                                <td><button name="editar" class="btn btn-success my-2 my-sm-0"  type="submit"> Editar </button> 
                            <input type="hidden" name="id_empleado" value="<?php echo $mostrar['id_empleado']; ?>"></td>
                            </form>
                            <form method="POST" action="empleadosEliminar.php">
                                <td><button value="<?php echo $mostrar['id_empleado']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button> </td>
                            </form>

                        </table>
                    </td>



                <?php
            }
                ?>

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
                        window.location.href = "tablaEmpleados.php";
                    }, 1000);
                </script>

        <?php
            }
        } else {
            $eliminar = 'null';
        }

        ?>
</body>

</html>