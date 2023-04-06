<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$id_curso = $_POST["id_curso"];
$causa = $_POST["causa"];
$fecha = $_POST["fecha"];
$tipo = $_POST["tipo"];

#var_dump($_POST);

$agregarTarea = "INSERT INTO tbl_tareas_programadas (id_curso,tipo,datos,fecha) 
VALUES ('$id_curso','$tipo','$causa','$fecha')";

$result = mysqli_query($connect, $agregarTarea);
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
    header ("Location: tareaProgramadaForm.php?estado=ok");

}
   


}
