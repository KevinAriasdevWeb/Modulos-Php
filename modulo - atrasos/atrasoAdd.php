<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$fecha_atraso = $_POST["fecha_atraso"];
$minutos = $_POST["minutos"];
$id_empleado = $_POST["id_empleado"];

#var_dump($_POST);

$agregarAtraso = "INSERT INTO tbl_atrasos (fecha_atraso,minutos_atraso,id_empleado) 
VALUES ('$fecha_atraso','$minutos','$id_empleado')";

$result = mysqli_query($connect, $agregarAtraso);
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
    header ("Location: atrasoForm.php?estado=ok");

}
   


}
