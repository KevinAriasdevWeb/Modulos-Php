<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);


$sql1= ("SELECT * FROM tbl_medio_pago");
$resultado = mysqli_query($connect, $sql1);
if (!$resultado){
    die('Falla al ingreso de datos');
}else{

}

$sql2= ("SELECT * FROM tbl_movimientos_categorias");
$resultado2 = mysqli_query($connect, $sql2);
if (!$resultado2){
    die('Falla al ingreso de datos');
}else{

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
    <title>Formulario Movimiento</title>
</head>
<body>


<?php





?>




<div class="container p-4 ">

<div class="row m-0 justify-content-center">
    <div class="col p-5 text-center">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="movimientoAdd.php">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="inputIdCreador">Creador</label>
                            <input type="text" name="id_creador"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="ID Creador" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputFechaMovimiento">Fecha Movimiento</label>
                            <input type="date" name="fecha_movimiento" placeholder="Fecha Movimiento" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputMonto">Monto</label>
                            <input type="text" name="monto" placeholder="Monto (Numeros)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" >
                        </div>
                       <?php $fecha = date("Y-m-d");
                         ?>
                         <input type="hidden" name="fecha_ingreso" value="<?php echo $fecha?>" class="form-control" >
                        <div class="form-group col-md-4">
                        <label for="inputTipo">Tipo</label>
                           <select name="tipo" class="form-control">
                           <option value="" selected>Tipo</option>
                                        <option value="ingreso">Ingreso</option>
                                        <option value="egreso">Egreso</option>
                           </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="medio_pago">Medio Pago</label>
                        <select name="medio_pago" class="form-control">
                              <option value="">Seleccione medio de pago</option>
                              <?php
                                  foreach ($resultado as $row){
                                    echo '<option value="' .$row['nombre']. '">' . $row['nombre'] .' </option>';
                                  }
                                ?>
                        </select> 
                        </div>
                        <div class="form-group col-md-4">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" class="form-control">
                              <option value="">Seleccione categoria</option>
                              <?php
                                  foreach ($resultado2 as $row){
                                    echo '<option value="' .$row['categoria']. '">' . $row['categoria'] .' </option>';
                                  }
                                ?>
                        </select> 
                        </div>
                        <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                            Ingresar 
                        </button>
                </form>
            </div>
        </div>
    </div>
    <?php

if(isset($_GET['estado'])){
    $estado = $_GET['estado'];
    if($estado == "ok"){
    ?>
    <script type="text/javascript">

        swal({
            title:'Datos ingresados correctamente!',
            icon: 'success',
            timer: 5000,
           
    
    
        });
        setTimeout( function() { window.location.href = "tablamovimiento.php"; }, 1500 );

</script>

<?php
    }
}else{
    $estado = 'null';
}

 ?>
    
</body>
</html>