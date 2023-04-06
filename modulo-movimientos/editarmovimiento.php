<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
include('conexion.php');
ini_set('default_charset', 'utf-8');



if (isset($_POST['editar-movimiento'])) {

    $id_movimiento = $_POST["id_movimiento"];
    $id_creador = $_POST["id_creador"];
    $fecha_movimiento = $_POST["fecha_movimiento"];
    $monto = $_POST["monto"];
    $tipo = $_POST["tipo"];
    $medio_pago = $_POST["medio_pago"];
    $categoria = $_POST["categoria"];

    $sql1 = ("UPDATE tbl_movimiento SET id_creador='$id_creador', fecha_movimiento='$fecha_movimiento',monto='$monto',
    tipo='$tipo', medio_pago='$medio_pago', categoria='$categoria' WHERE id_movimiento = '$id_movimiento' ");
    $result1 = mysqli_query($connect, $sql1);
    if (!$result1) {
        die('Query Failed');
    } else {

        header("Location: editarmovimiento.php?movimiento=ok");
    }
}

$sql3= "SELECT * FROM tbl_medio_pago";
$result3 = mysqli_query($connect, $sql3);
if (!$result3) {
    die('Falla en conectarse');
}
$sql4= "SELECT * FROM tbl_movimientos_categorias";
$result4 = mysqli_query($connect, $sql4);
if (!$result4) {
    die('Falla en conectarse');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Editar Movimiento</title>
</head>

<body>


 

    <div class="container p-4 ">
        <div class="row m-0 justify-content-center text-center">
             <div class="col p-5 text-center">
            <div class="card">
                <div class="card-body">

                    <?php //inicio de 
                    //Consulta SQL para buscador por id y encontrar datos de contacto a editar
                    //inicio de get recibiendo ID
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        if ($id == $id) {
                            $search_id = $id;

                            $sql2 = "SELECT * FROM tbl_movimiento  WHERE id_movimiento  ='" . $search_id . "' ";
                            $result2 = mysqli_query($connect, $sql2);
                            if ($result2) {

                                while ($fila = $result2->fetch_assoc()) {
                    ?>
                                    <form action="editarmovimiento.php" method="POST" >
                                        <div class="form-row">

                                            <input type="hidden" name ="id_movimiento" value="<?php echo $fila['id_movimiento']; ?>">

                                            <div class="form-group col-md-4">
                                                <label for="inputCategoria">Id_creador</label>
                                                <input type="text" name="id_creador" value="<?php echo $fila['id_creador']; ?>" placeholder="Ingrese categoria" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCategoria">Fecha Movimiento</label>
                                                <input type="text" name="fecha_movimiento" value="<?php echo $fila['fecha_movimiento']; ?>" placeholder="Ingrese categoria" class="form-control">
                                            </div>
                                    
                                            <div class="form-group col-md-4">
                                                <label for="inputCategoria">Monto</label>
                                                <input type="text" name="monto" value="<?php echo $fila['monto']; ?>" placeholder="Ingrese categoria" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                             <label for="activa">Tipo</label>
                                             <select name="tipo" class="form-control" >
                                                     <option value="" selected>Seleccione Tipo</option>
                                                          <?php 
                                                              foreach ($result2 as $fila) {
                                                            ?>
                                                            <?php

                                                              echo '<option value="ingreso" ';


                                                              if ($fila['tipo'] == "ingreso") {
                                                                  echo ' selected ';
                                                             }
                                                             echo ' >ingreso </option>';
                                                             echo '<option value="egreso" ';
                                                             if ($fila['tipo'] == "egreso") {
                                                                echo ' selected ';
                                                                                }
                                                                                echo ' >egreso </option>';
                                                        ?>
                                                        <?php
                                                          }
                                                       ?>
                                                </select>   
                                           </div>
                                           
                                            <div class="form-group col-md-4">
                                                <label for="inputTipo">Medio Pago</label>
                                                <select name="medio_pago" class="form-control">
                                                    <option value="">Seleccione tipo</option>
                                                    <?php 
                                                     foreach ($result3 as $mostrar3) {
                                                      ?>
                                                 <?php

                                               echo '<option value="'.$mostrar3['nombre'].'" ';


                                              if ($fila['medio_pago'] == $mostrar3['nombre']) {
                                              echo ' selected ';
                                                             }
                                                             echo ' >'.$mostrar3['nombre'].' </option>';
                                                            
                                                           
                                                     }
                                                   ?>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputTipo">Categoria</label>
                                                <select name="categoria" class="form-control">
                                                    <option value="">Seleccione Categoria</option>
                                                    <?php 
                                                     foreach ($result4 as $mostrar4) {
                                                      ?>
                                                 <?php

                                               echo '<option value="'.$mostrar4['categoria'].'" ';


                                              if ($fila['categoria'] == $mostrar4['categoria']) {
                                              echo ' selected ';
                                                             }
                                                             echo ' >'.$mostrar4['categoria'].' </option>';
                                                            
                                                           
                                                     }
                                                   ?>
                                                   
                                                </select>
                                            </div>



                                            <button type="submit" name="editar-movimiento" class="btn btn-success btn-block text-center">
                                                Editar Movimiento
                                            </button>


                                    </form>
                    <?php
                                    //final del result 1
                                }
                            }
                        }
                    } //final de get con ID

                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <?php
    //mensaje alert que se activa despues de ingresar o registrar una accion
    if (isset($_GET['movimiento'])) {
        $movimiento = $_GET['movimiento'];
        if ($movimiento == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Movimiento Editado con exito!',
                    icon: 'success',
                    timer: 2000,



                });
                setTimeout(function() {
                    window.location.href = "tablamovimiento.php";
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