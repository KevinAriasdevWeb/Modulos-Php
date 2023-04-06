<?php
include('conexion.php');
ini_set('default_charset', 'utf-8');

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {


    $buscar = $_POST['buscar'];
    $campo = $_POST['campo'];

    $busqueda = " AND $campo LIKE '%$buscar%' ";
}
if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['campo2'])) {


    $buscar = $_POST['campo2'];
    $campo = $_POST['campo'];

    $busqueda2 = " AND categoria LIKE '%$buscar%' ";
}else {
    $busqueda2 = '';
}



##CONSULTA PARA TRAER LOS DATOS A LA TABLA

$sqlInventario = "SELECT * FROM tbl_inventario where 1=1 $busqueda $busqueda2";


##CONSULTA CATEGORIA MATERIALES
$sqlCategoria = "SELECT * FROM tbl_categoria_materiales";
$consultaCategoria = mysqli_query($connect, $sqlCategoria);



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
    <title>Tabla Inventario</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      
        <ul class="navbar-nav ml-auto">
            <a href="http://elc.cl/test/inventario/inventarioForm.php" class="btn btn-success mr-sm-3" target="_blank">Crear Inventario </a>
            <form method="POST" class="form-inline my-2 my-lg-0">
                <select name="campo" class="form-control mr-sm-3" required="required">
                    <option value="">Seleccione Campo</option>
                    <option value="nombre">Nombre </option>
                    <option value="descripcion">Descripcion</option>
                    <option value="stock">Stock</option>
                </select>
                <select name="campo2" class="form-control mr-sm-3">
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

                <input name="buscar" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button name="enviar" value="1" class="btn btn-success mr-sm-3 " type="submit"> Buscar </button>
                <button name="mostrar" class="btn btn-success my-2 my-sm-0" type="button" onclick="window.location.href=window.location.href"> Mostrar Todo </button>
            </form>
        </ul>
    </nav>

    <div class="row m-0 justify-content-center">

        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">STOCK</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">ELIMINAR</th>
                </tr>
            </thead>

            <?php
            $consultaInventario = mysqli_query($connect, $sqlInventario);
            while ($CI = $consultaInventario->fetch_assoc()) {
            ?>

                <tbody>
                    <tr>
                        <th><?php echo $CI['nombre']; ?></th>
                        <th><?php foreach($consultaCategoria as $CM){
                            if($CM['id_categoria']==$CI['categoria']){
                            echo $CM['nombre'];
                            }
                        } ?></th>
                        <th><?php echo $CI['descripcion']; ?></th>
                        <th><?php echo $CI['stock']; ?></th>

                        <form method="POST" action="inventarioEditar.php">
                            <td>
                                <button name="editar" value="<?php echo $CI['id_inventario']; ?>" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button>
                            </td>
                        </form>
                        <form method="POST" action="inventarioEliminar.php">
                            <td><button value="<?php echo $CI['id_inventario']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button> </td>
                        </form>
                    </tr>
                </tbody>

            <?php
            }
            ?>
        </table>
    </div>
    <?php

    if (isset($_GET['eliminar'])) {
        $eliminar = $_GET['eliminar'];
        if ($eliminar == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Inventario eliminado correctamente!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "inventarioTabla.php";
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