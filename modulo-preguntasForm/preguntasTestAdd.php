<?php

include ('conexion.php');
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);


if(isset($_POST["ingresar_test"])){


$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$tiempo = $_POST["tiempo"];
$especialidad = $_POST["especialidad"];
$preguntas = $_POST['preguntas'];
$preguntas2=implode(",",$preguntas);


$agregarPreguntas = "INSERT INTO tbl_test (nombre, id_especialidad, tiempo, preguntas, descripcion) 
VALUES ('$nombre', '$especialidad', '$tiempo', '$preguntas2', '$descripcion')";

/**
$sql=$insertar;
       if(!$connect->query($sql)){
        $timestamp = new DateTime();
       $data_err = " {
            \"title\": \" Select statement error \",
            \"date_time\": ".$timestamp->getTimestamp().",
            \"error\":\" ".$connect->error." \"
           } "; // Do more information
        }
           echo "<pre>".$data_err."</pre>"; 
**/

$result = mysqli_query($connect, $agregarPreguntas);
if (!$result){
    die('Falla al ingreso de datos');
}else{
    header ("Location: preguntasTestForm.php?estado=ok");

}




}
