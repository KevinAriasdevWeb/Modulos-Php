<?php
include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');
//Consulta SQL 
$sql2 = ("SELECT * FROM tbl_ponderaciones");
//$result2 = mysqli_query($connect, $sql2);
//Si trae datos enviar-ponderacion agrega datos a la tabla ponderaciones.
if (isset($_POST["enviar-ponderacion"])) {

    $nombre = $_POST['nombre'];
    $ponderacion = $_POST['ponderacion'];

    $sql1 = ("INSERT INTO tbl_ponderaciones(nombre,ponderacion) VALUES ('$nombre','$ponderacion')");

    $result1 = mysqli_query($connect, $sql1);

    if (!$result1) {
        die('Falla al ingreso de datos');
    } else {
        header("Location: ponderaciones.php?estado=ok");
    }
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
    <title>Ponderaciones</title>
</head>

<body>
    <?php
    //Formulario Ingreso de ponderaciones
    ?>

    <div class="container p-4 ">
        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="ponderaciones.php">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNombre">Nombre</label>
                                    <input type="text" name="nombre" maxlength="255" placeholder="Ingrese Nombre" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputPonderacion">Ponderacion</label>
                                    <input type="text" name="ponderacion" placeholder="Ingrese Ponderacion" class="form-control" required>
                                </div>

                                <button name="enviar-ponderacion" type="submit" class="btn btn-success btn-block text-center">
                                    Ingresar Ponderacion
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php //Tabla Para mostrar ponderaciones 
    ?>


    <div class="row m-0 justify-content-center">

        <table class="table" border="0">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PONDERACION</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">ELIMINAR</th>
                </tr>
            </thead>

            <?php
            $result2 = mysqli_query($connect, $sql2);
            while ($mostrar = $result2->fetch_assoc()) {
            ?>

                <tbody>
                    <tr>

                        <td>
                            <form method="POST" action="ponderacion-editar.php?id=<?php echo $mostrar['id_ponderaciones'] ?>">
                                <input type="text" name="nombre_ponderacion" value="<?php echo $mostrar['nombre'] ?>">
                           
                        </td>
                        <td>
                       
                        <input type="tet" name="ponderacion" value="<?php echo $mostrar['ponderacion'] ?>">%
                    
                        </td>
                        <td>
                           
                                <button name="editar-ponderacion" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button>
                            </form>
                        </td>

                        <td>
                            <form method="POST" action="ponderacion-eliminar.php">
                                <button value="<?php echo $mostrar['id_ponderaciones']; ?>" name="ponderacion-eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button>
                            </form>
                        </td>
                    </tr>

                <?php
            }
                ?>


                </tbody>
        </table>
    </div>













    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <?php
    //mensaje cuando se ingresa datos hacia la tabla tbl_ponderaciones
    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Datos ingresados correctamente!',
                    icon: 'success',
                    timer: 5000,
                });
                setTimeout(function() {
                    window.location.href = "ponderaciones.php";
                }, 1500);
            </script>

        <?php
        }
    } else {
        $estado = 'null';
    }

    //Mensaje para eliminar ponderacion de tabla
    if (isset($_GET['eliminar'])) {
        $eliminar = $_GET['eliminar'];
        if ($eliminar == "ok") {
        ?>
            <script type="text/javascript">
                swal({
                    title: 'Ponderacion eliminada correctamente!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "ponderaciones.php";
                }, 1000);
            </script>

    <?php
        }
    } else {
        $eliminar = 'null';
    }

    
    //Mensaje para editar ponderacion de tabla
    if (isset($_GET['editar'])) {
        $editar = $_GET['editar'];
        if ($editar == "ok") {
        ?>
            <script type="text/javascript">
                swal({
                    title: 'Ponderacion Editada correctamente!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "ponderaciones.php";
                }, 1000);
            </script>

    <?php
        }
    } else {
        $editar = 'null';
    }



    ?>




</body>

</html>



<?php






?>