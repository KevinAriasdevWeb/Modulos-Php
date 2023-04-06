<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$codigo_matricula = $_POST["codigo_matricula"];
$id_curso = $_POST["id_curso"];
$fecha = $_POST["fecha"];
$estado = $_POST["estado"];

#var_dump($_POST);

$sql = "INSERT INTO tbl_diplomas (codigo_matricula,id_curso,fecha,estado) VALUES ('$codigo_matricula','$id_curso',
'$fecha','$estado')";

$result = mysqli_query($connect, $sql);
if (!$result){
    die('Falla al ingreso de datos');
}else{
    header ("Location: diplomasForm.php?estado=ok");

}
   


}
