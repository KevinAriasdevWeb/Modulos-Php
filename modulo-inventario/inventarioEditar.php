<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

include('conexion.php');

##SE EJECUTA LA CONSULTA EDITAR
if (isset($_POST['editar-inventario'])) {
    $id_inventario = $_POST["id_inventario"];
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion"];
    $stock = $_POST["stock"];


    $sql1 = ("UPDATE tbl_inventario SET  nombre='$nombre', categoria='$categoria', descripcion='$descripcion', stock='$stock'
     WHERE id_inventario = '$id_inventario' ");
    $inventarioUpdate = mysqli_query($connect, $sql1);
    if (!$inventarioUpdate) {
        die('Query Failed');
    } else {

        header("Location: inventarioEditar.php?estado=ok");
    }
}

##CONSULTA CATEGORIA MATERIALES
$sql = "SELECT * FROM tbl_categoria_materiales";
$consultaCategoria = mysqli_query($connect, $sql);
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
    <title>Edita Categoria</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Editar Inventario</a>
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

                            $sql2 = "SELECT * FROM tbl_inventario  WHERE id_inventario  ='" . $search_id . "' ";
                            $editarInventario = mysqli_query($connect, $sql2);
                            if ($editarInventario) {

                                while ($EI = $editarInventario->fetch_assoc()) {
                    ?>
                                    <form method="POST" action="inventarioEditar.php">

                                        <div class="form">

                                            <div class="form text-center">

                                                <div class="form-group col-md-auto ">
                                                    <label for="inputCodigo">Nombre</label>
                                                    <input type="text" name="nombre" value="<?php echo $EI['nombre']; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-auto">
                                                    <label for="negocios">Categoria</label>

                                                    <input type="hidden" name="id_inventario" value="<?php echo $EI['id_inventario']; ?>">
                                                    <select name="categoria" class="form-control" required>
                                                        <option value="" selected>Seleccione categoria</option>
                                                        <?php
                                                        foreach ($consultaCategoria as $consultaMateriales) {

                                                            echo '<option value="' . $consultaMateriales['id_categoria'] . '" ';
                                                            if ($EI['categoria'] == $consultaMateriales['id_categoria']) {
                                                                echo ' selected ';
                                                            }
                                                            echo ' >' . $consultaMateriales['nombre'] . '</option>';
                                                        }


                                                        ?>

                                                    </select>

                                                </div>

                                                <div class="form-group col-md-auto">
                                                    <label for="exampleFormControlTextarea1">Descripcion</label>
                                                    <textarea class="form-control" name="descripcion" rows="3"> <?php echo $EI['descripcion']; ?> </textarea>
                                                </div>

                                                <div class="form-group col-md-auto">
                                                    <label for="inputCodigo">Stock </label>
                                                    <input type="text" name="stock" value="<?php echo $EI['stock']; ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <button name="editar-inventario" type="submit" class="btn btn-warning btn-block text-center">
                                                Editar inventario
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
                    title: 'Inventario Editado correctamente!',
                    icon: 'success',
                    timer: 3000,



                });
                setTimeout(function() {
                    window.location.href = "inventarioTabla.php";
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