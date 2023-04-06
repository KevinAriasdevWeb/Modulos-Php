<?php
include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

##CONSULTA CATEGORIA MATERIALES
$sql = "SELECT * FROM tbl_categoria_materiales";
$consultaCategoria = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Inventario formulario</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="" class="navbar-brand">Inventario Formulario</a>
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>
    <div class="container p-4 ">
        <div class="row m-0 justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="inventarioAdd.php">

                        <div class="form text-center">
                           
                            <div class="form-group col-md-auto ">
                                <label for="inputCodigo">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group col-md-auto">
                                <label for="negocios">Categoria</label>
                                <select name="categoria" class="form-control" required>
                                    <option value="" selected>Seleccione Categoria</option>
                                    <?php
                                    foreach ($consultaCategoria as $CM) {
                                    ?>

                                        <option value="<?php echo $CM['id_categoria'] ?>">
                                            <?php echo $CM['nombre'];?>
                                        </option>

                                    <?php
                                    }


                                    ?>

                                </select>

                            </div>
                            
                            <div class="form-group col-md-auto">
                                <label for="inputCodigo">Descripcion</label>
                                <input type="text" name="descripcion" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-auto">
                                <label for="inputCodigo">Stock </label>
                                <input type="text" name="stock" class="form-control" required>
                            </div>

                            <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                                Ingresar Inventario
                            </button>
                        </div>
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
                    title: 'Inventario ingresado correctamente!',
                    icon: 'success',
                    timer: 1500,



                });
                setTimeout(function() {
                    window.location.href = "inventarioTabla.php";
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