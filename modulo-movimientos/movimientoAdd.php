<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$id_creador = $_POST["id_creador"];
$fecha_movimiento = $_POST["fecha_movimiento"];
$monto = $_POST["monto"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$tipo = $_POST["tipo"];
$medio_pago = $_POST["medio_pago"];
$categoria = $_POST["categoria"];


var_dump($_POST);

$agregarMovimiento = "INSERT INTO tbl_movimiento (id_creador,fecha_movimiento,fecha_ingreso,monto,tipo,medio_pago,categoria) 
VALUES ('$id_creador','$fecha_movimiento','$fecha_ingreso','$monto','$tipo','$medio_pago','$categoria')";

$result = mysqli_query($connect, $agregarMovimiento);
/**
if(!$connect->query($agregarMovimiento)){
    $timestamp = new DateTime();
   $data_err = " {
        \"title\": \" Select statement error \",
        \"date_time\": ".$timestamp->getTimestamp().",
        \"error\":\" ".$connect->error." \"
       } "; // Do more information
    }
       echo "<pre>".$data_err."</pre>";
 */
if (!$result){
    die('Falla al ingreso de datos');
}else{
    header ("Location: movimientoForm.php?estado=ok");

}
   


}
