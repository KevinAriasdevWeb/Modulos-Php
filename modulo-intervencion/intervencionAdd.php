<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$codigo_matricula = $_POST["codigo_matricula"];
$id_clase = $_POST["id_clase"];
$id_curso = $_POST["id_curso"];
$id_especialidad = $_POST["id_especialidad"];
$estado = $_POST["estado"];




#var_dump($_POST);

$sql = "INSERT INTO tbl_intervencion_alumnos (codigo_matricula,id_clase,id_curso,id_especialidad,estado) 
VALUES ('$codigo_matricula','$id_clase','$id_curso','$id_especialidad','$estado')";

$intervencionAdd = mysqli_query($connect, $sql);

if (!$intervencionAdd){
    die('Falla al ingreso de datos');
}else{
    header ("Location: intervencionAlumno.php");
}
   


}
